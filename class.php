<?php
//https://vk.com/dev/objects/user
class User
{
	var $id;
	var $first_name;
	var $last_name;
	var $deactivated;
	var $hidden;
}
//https://vk.com/dev/photo
class Photo
{
	var $id;
	var $album_id;
	var $owner_id;
	var $user_id;
	var $text;
	var $date;
	var $sizes;
	var $photo_75;
	var $photo_130;
	var $photo_604;
	var $photo_807;
	var $photo_1280;
	var $photo_2560;
	var $width;
	var $height;
}
//https://vk.com/dev/objects/group
class Group {
	var $id;
	var $name;	
	var $screen_name;
	var $is_closed;
	var $deactivated;
	var $is_admin;
	var $admin_level;
	var $is_member;
	var $invited_by;
	var $has_photo;
	var $photo_50;
	var $photo_100;
	var $photo_200;
}
class User_AddInfo
{
	var $about;
	var $activites;
	var $bdate;
	var $blacklisted;
	var $blacklisted_by_me;
	var $books;
	var $can_post;
	var $can_see_all_posts;
	var $can_see_audio;
	var $can_send_friend_request;
	var $can_write_private_message;
	var $career; // объект класса Career
	var $city; // объект класса City
	var $common_count;	
	var $connections; 
	var $contacts;  // объект класса Contact
	var $counters; // объект класса Counter
	var $country; // объект класса Country
	var $crop_photo; // объект класса Crop_Photo
	var $domain;
	var $education; // объект класса Education
	var $exports;
	var $first_name_case;
	var $followers_count;
	var $friend_status;
	var $games;
	var $has_mobile;
	var $has_photo;
	var $home_town;
	var $interests;
	var $is_favorite;
	var $is_friend;
	var $is_hidden_from_feed;
	var $last_name_case;
	var $last_seen;
	var $lists;
	var $maiden_name;
	var $military; // объект класса Military
	var $movies;
	var $music;
	var $nickname;
	var $occupation; // объект класса Occupation
	var $online;
	var $personal; // объект класса Personal
	var $photo_50;
	var $photo_100;
	var $photo_200_orig;
	var $photo_200;
	var $photo_400_orig;
	var $photo_id;
	var $photo_max;
	var $photo_max_orig;
	var $quotes;
	var $relatives; // массив объектов Relative
	var $relation;
	var $schools; // массив объектов School
	var $screen_name;
	var $sex;
	var $site;
	var $status;
	var $timezone;
	var $tv;
	var $universities; // массив объектов University
	var $verified;
	var $wall_comments;
	
}
class Career
{
	var $group_id;
	var $company;
	var $country_id;
	var $city_id;
	var $city_name;
	var $from;
	var $until;
	var $position;
}

class City
{
	var $id;
	var $title;
}
class Contact
{
	var $mobile_phone;
	var $home_phone;
}
class Counter
{
	var $albums;
	var $videos;
	var $audios;
	var $photos;
	var $notes;
	var $friends;
	var $groups;
	var $online_friends;
	var $mutual_friends;
	var $user_videos;
	var $followers;
	var $pages;
}
class Country
{
   var $id;
   var $title;
}
class Crop_Photo
{
	var $photo; // объект класса Photo
	var $crop; // объект класса Crop
	var $rect // тоже объект класса Crop
}
class Crop
{
	var $x;
	var $y;
	var $x2;
	var $y2;
}
class Education
{
	var $university;
	var $university_name;
	var $faculty;
	var $faculty_name;
	var $graduation;
}
class Military
{
	var $unit;
	var $unit_id;
	var $country_id;
	var $from;
	var $until;
}
class Occupation
{
	var $type;
	var $id;
	var $name;
}
class Personal
{
	var $political;
	var $langs;
	var $religion;
	var $inspired_by;
	var $people_main;
	var $life_main;
	var $smoking;
	var $alcohol;
}
class Relative
{
	var $id;
	var $name;
	var $type;
}
class School
{
	var $id;
	var $country;
	var $city;
	var $name;
	var $year_from;
	var $year_to;
	var $year_graduated;
	var $class;
	var $speciality;
	var $type;
	var $type_str;
}
class University
{
	var $id;
	var $country;
	var $city;
	var $name;
	var $faculty;
	var $faculty_name;
	var $chair;
	var $chair_name;
	var $graduation;
	var $education_form;
	var $education_status;
}
