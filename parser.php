<?php
setlocale (LC_CTYPE, "ru_RU.UTF-8");
require 'classes/Users.php';
require 'classes/Group.php';
require 'classes/MembersOfGroup.php';

class pars {

    public static function cURL($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public static function GetUser($user_id, $access_token) {
        $user = new Users();
        $params = array(
            'user_ids' => $user_id,
            'fields' => 'photo_200,photo_50,sex, bdate, city, country, home_town,relatives,relation,contacts,online',
            'name_case' => 'Nom',
            'v' => '5.63',
            'access_token' => $access_token
        );
        $url = 'https://api.vk.com/method/users.get?' . http_build_query($params);
        $response = pars::cURL($url);
        foreach (json_decode($response)->response[0] as $key => $value) {
            if (is_object($value)) {
                $user->{$key} = (array) $value;
            } else {
                $user->{$key} = $value;
            }
        }
        $user->relation = Users::$rel[$user->relation];
        pars::GetGroupByUser($user, 0, $access_token);       
        return $user;
    }

    static function GetNameById($user) {
        if ($user->id < 0) {
            return "<span>" . $user->name . ";</span>";
        } else {
            $params = array(
                'user_ids' => $user->id,
                'name_case' => 'Nom',
                'v' => '5.63'
            );
            $url = 'https://api.vk.com/method/users.get?' . http_build_query($params);
            $response = json_decode(pars::cURL($url));
            $response = $response->response[0];
            return '<a href="http://localhost/site/main.php?id=' . $user->id . '">' . $response->first_name . " " . $response->last_name . ";</a> ";
        }
    }

    static function GetGroupByUser($user, $offset, $access_token) {
        $params = array(
            'user_id' => $user->id,
            'extended' => 1,
            'fields' => 'members_count',
            'offset' => $offset,
            'count' => 100,
            'v' => '5.63',
            'access_token' => $access_token
        );
        $url = 'https://api.vk.com/method/groups.get?' . http_build_query($params);
        $response = pars::cURL($url);
        $response = json_decode($response);
        if (count(($response->response->items)) > 0) {
            foreach ($response->response->items as $group) {
                $gr = new Group();
                foreach ($group as $key => $field) {
                    $gr->{$key} = $field;
                }
                array_push($user->groups, $gr);
            }
            pars::GetGroupByUser($user, $offset + 100, $access_token);
        }
    }

    static function GetGroup($group_id, $access_token) {
        $group = new Group();
        $params = array(
            'group_id' => $group_id,
            'fields' => 'members_count',
            'v' => '5.63',
            'accesstoken' => $access_token
        );
        $url = 'https://api.vk.com/method/groups.getById?' . http_build_query($params);
        $response = json_decode(pars::cURL($url));
        foreach ($response->response[0] as $key => $value) {
            $group->{$key} = $value;
        }
        pars::GetMembersOfGroup($group_id, $access_token, 0, $group);
        return $group;
    }

    static function GetMembersOfGroup($group_id, $access_token, $offset, $group) {
        $params = array(
            'group_id' => $group_id,
            'sort' => 'id_asc',
            'offset' => $offset,
            'count' => 1000,
            'fields' => 'relation,city,photo_50',
            'v' => '5.63',
            'access_token' => $access_token
        );
        $url = 'https://api.vk.com/method/groups.getMembers?' . http_build_query($params);
        $items = json_decode(pars::cURL($url))->response->items;
//        if (is_array($items)) {
            foreach ($items as $value) {
                $member = new MembersOfGroup();
                $member->id = $value->id;
                $member->first_name = $value->first_name;
                $member->last_name = $value->last_name;
                if (property_exists($value, 'city')) {
                    $member->city = $value->city->title;
                } else {
                    $member->city = 'не указано';
                }
                $member->photo_50 = $value->photo_50;
                array_push($group->members, $member);
//            }
//            pars::GetMembersOfGroup($group_id, $access_token, $offset+100, $group);
        }
    }

    static function GetMemberInfo($id_member, $access_token) {
        $member = new MembersOfGroup();
        $params = array(
            'user_ids' => $id_member,
            'fields' => 'photo_50, city',
            'name_case' => 'Nom',
            'v' => '5.63',
            'access_token' => $access_token
        );
        $url = 'https://api.vk.com/method/users.get?' . http_build_query($params);
        $response = pars::cURL($url);
        set_time_limit(0.333);
        foreach (json_decode($response)->response[0] as $key => $value) {
            if (is_object($value)) {
                $member->{$key} = (array) $value;
            } else {
                $member->{$key} = $value;
            }
        }
        return $member;
    }

    static function ObjecttoJSON($object){
        return json_encode($object,JSON_UNESCAPED_UNICODE);
    }
    
    static function JSONtoXML($json) {
        $xml=new SimpleXMLElement('<data/>');
        pars::arrayToXml($json, $xml);
        return html_entity_decode($xml->asXML(),ENT_QUOTES, 'utf-8');
    }
    static function arrayToXml($array,&$xml){
        foreach ($array as $key => $value) {
            if(is_array($value) || is_object($value)){
                pars::arrayToXml($value, $xml->addChild($key));
            }else{
                $xml->addChild($key, htmlspecialchars($value));
            }
        }        
    }
    
    static function JSONtoStr($json,&$result){
        foreach ($json as $key => $value) {
            if(is_array($value) || is_object($value)){
                $result.='Æ';
                pars::JSONtoStr($value, $result);
                $result=$result.'Æ';
            }else{
                $result.=$key.':'.$value.'Ћ';
            }
        }
    }

}
