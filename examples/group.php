<html>
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tablefilter/2.5.0/tablefilter.js"></script>
    <script src="Content/jquery.tablesorter.js"></script>
    <script src="Content/jquery.uitablefilter.js" type="text/javascript"></script>
    <link href="Content/bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="Content/style.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="Content/bootstrap.js"></script>
    <script>
        jQuery(document).ready(function ($) {
            $("#myTable").tablesorter({});
        });

        $(function () {
            $("#filter").keyup(function () {
                $.uiTableFilter($("#myTable"), this.value);
            });
        });
        function Exit(){
            
            sessionStorage.removeItem('token');
            sessionStorage.removeItem('code');
            sessionStorage.removeItem('user');
            alert("gfhgdhdgh");
            window.location.href="index.php";
        }
    </script>
    <?php
    require 'config.php';
    require 'parsers/parser.php';
    session_start();
    if (!isset($_GET["id"])) {

        //Если не указан ID группы, то редиректим на страницу пользователя
        header('Location: http://localhost/site/main.php');
    } else {
        if (!isset($_SESSION['token'])) {
            if (isset($_SESSION['code'])) {
                $token = GetToken();
                $_SESSION['token'] = $token;
                $group = pars::GetGroup($_GET["id"], $_SESSION[token]->access_token);
            } else {
                header('Location:' . $get_access_code_url . http_build_query($params_code));
            }
        } else {
            $group = pars::GetGroup($_GET["id"], $_SESSION['token']->access_token);
        }
    }
    ?>
    <body>
        <div class="container-fluid">
            <nav class="navbar navbar-default navbar-fixed-top" style="background-color: #286090">
                <ul class="nav navbar-nav navbar-left">
                    <li>
                        <h1 style="color: #c4e3f3; margin-left: 20px;">AppTest</h1>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right" style="margin-right: 5px;">
                    <li class="dropdown">
                        <a style="color: white" class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo '<img style="width:40px;height:40px" src="' . $_SESSION['user']->photo_50 . '" class="img-circle"/>' . $_SESSION['user']->first_name; ?>
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><?php echo '<a href="http://localhost/site/main.php?id=' . $_SESSION['token']->user_id . '"><span class="glyphicon glyphicon-home"></span> Моя страница</a>' ?></li>
                            <li class="divider"></li>
                            <li><a href="session_destroy.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                        </ul>
                    </li>

                </ul>
            </nav>
            <div class="row" style="margin-top: 80px;">
                <div class="col-sm-10">
                    <?php echo "<p><h2>" . $group->name . "</h2></p><p>" . $group->screen_name . "</p>" ?>
                    <table class="table white_border_tr">
                        <tbody>
                            <tr>
                                <td>Тип страницы</td>
                                <td><?php echo $group->type; ?></td>
                            </tr>
                            <tr>
                                <td>Количество участников</td>
                                <td><?php echo $group->members_count; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-2">
                    <?php echo '<img src="' . $group->photo_200 . '" class="img-thumbnail"/>'; ?>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class = "col-sm-offset-2 col-sm-8 panel">
                    <input id="filter" type = "text" class = "form-control" placeholder="Введите чувака...">

                    <table class="table tablesorter" id="myTable">
                        <thead>
                        <td></td>
                        <th>Участник</th>
                        <th>Город</th>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($group->members as $value) {
                                echo '<tr><td style="width:1;"><img src="' . $value->photo_50 . '" class="img-circle" style="float:rigth;"/></td>' .
                                '<td><a href="http://localhost/site/main.php?id=' . $value->id . '"/>' . $value->first_name . ' ' . $value->last_name . '</td>' .
                                '<td>' . $value->city . '</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>

