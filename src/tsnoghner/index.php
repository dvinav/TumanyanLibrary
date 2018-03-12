<html>
    <?php
        date_default_timezone_set('UTC');
        include("../libraries/jdf/jdf.php");
        $db = mysqli_connect('db', 'root', '');
        if (!$db) {
            die("Database connection failed: " . mysqli_connect_error());
        }
        mysqli_select_db($db, 'slibrary') or die("Database selection failed: " . mysqli_error($db));
        if (isset($_POST['name'])) {
            $name = $_POST["name"];
            $book = $_POST["book"];
            $date = date("Y/m/d");
            $yeard = date("Y") * 365;
            $monthd = date("m") * 30;
            $day = date("d");
            $dayte = $yeard + $monthd + $day;
            $query = "insert into olialist (namee, bookname, date1, date1g, tamdid, date2) values ('".$name."', '".$book."', '".jdate("Y-m-d", strtotime("$date"), '', '', 'en')."', '".$dayte."', 1, NULL)";
            if (!mysqli_query($db, $query)) {
                echo "<p>Insert Error: " . mysqli_error($db) . "</p>";
            }
        }
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $date = date("Y/m/d");
            $quer = "update olialist set date2='".jdate("Y-m-d", strtotime("$date"), '', '', 'en')."' where id='".$id."'";
            if (!mysqli_query($db , $quer)) {
                echo "<p>Update Error: " . mysqli_error($db) . "</p>";
            }
        }
        if (isset($_POST['tamdid'])) {
            $tamdid = $_POST['tamdid'];
            $quer = "update olialist set tamdid=tamdid+1 where id='".$tamdid."'";
            if (!mysqli_query($db , $quer)) {
                echo "<p>Tamdid Error: " . mysqli_error($db) . "</p>";
            }
        }
        if (isset($_POST['del'])) {
            $del = $_POST['del'];
            $quer = "DELETE FROM olialist WHERE id = '".$del."'";
            if (!mysqli_query($db , $quer)) {
                echo "<p>Delete Error: " . mysqli_error($db) . "</p>";
            }
        }
        if (isset($_GET['search'])) {
            $squery = $_GET['search'];
            $squery = htmlspecialchars($squery);
            $result = mysqli_query($db, "SELECT * FROM olialist WHERE namee LIKE '%".$squery."%'");
            if (!$result) {
                echo "<p>Search Query Error: " . mysqli_error($db) . "</p>";
            }
        }
        else {
            $result = mysqli_query($db, 'SELECT * FROM olialist');
            if (!$result) {
                echo "<p>Fetch Query Error: " . mysqli_error($db) . "</p>";
            }
        }
    ?>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>فهرست کتابخانه اولیا</title>
        <link rel="shortcut icon" href="../resources/favicon.png" type="image/x-icon">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="../css/stylesheet.css">
        <link rel="stylesheet" href="../libraries/materializecss/materialize.min.css">
        <script src="../libraries/jquery/jquery-3.2.1.js"></script>
        <script src="../libraries/materializecss/materialize.min.js"></script>
        <script>
            function fade() {
                if (document.referrer == 'http://localhost:8080/') {
                    $('#main').css({
                    'transform': 'translateX(0px)',
                    'opacity': 1
                    })
                }
                else {
                    $('#main').css({
                    'transition': 'none',
                    'transform': 'translateX(0px)',
                    'opacity': 1
                    })
                }
            }
            function fadel() {
                $("#main").css({
                    'transition': '0.5s all ease-in',
                    "transform": "translateX(150px)",
                    "opacity": 0
                })
                setTimeout(function(){location.href = '../'}, 600)
            }
        </script>
        <script type="text/Javascript">
            Materialize.toast('hello', 2000)
            function tost() {
                var add = <?php echo (isset($_POST['name'])) ? 'true' : 'false'; ?>;
                var tam = <?php echo (isset($_POST['tamdid'])) ? 'true' : 'false'; ?>;
                var del = <?php echo (isset($_POST['del'])) ? 'true' : 'false'; ?>;
                var bar = <?php echo (isset($_POST['id'])) ? 'true' : 'false'; ?>;
                if (tam) {
                    Materialize.toast('تمدید شد', 2000);
                }
                if (add) {
                    Materialize.toast('اضافه شد', 2000);
                }
                if (del) {
                    Materialize.toast('حذف شد', 2000);
                }
                if (bar) {
                    Materialize.toast('تاریخ برگشت ثبت شد', 2000);
                }
            }
        </script>
    </head>
    <body onload="$('.modal').modal();fade();tost()">
        <div id="modal1" class="modal">
            <form action="index.php" method="get">
                <div class="modal-content">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">search</i>
                        <input name="search" id="icon_prefix" type="text">
                        <label for="icon_prefix">جست و جو</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="divider"></div>
                    <button type="submit" class="modal-action waves-effect waves-teal btn-flat">جست و جو</button>
                </div>
            </form>
        </div>
        <div id="modal2" class="modal">
            <form action="index.php" method="post">
                <div class="modal-content">
                    <div class="input-field col push-s1 s10">
                        <i class="material-icons prefix">account_circle</i>
                        <input type="text" name="name" id="name" required>
                        <label for="name">نام و نام خانوادگی</label>
                    </div>
                    <div class="input-field col s10 push-s1">
                        <i class="material-icons prefix">book</i>
                        <input type="text" name="book" id="book" required>
                        <label for="book">نام کتاب</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="divider"></div>
                    <button type="submit" class="modal-action waves-effect waves-teal btn-flat">افزودن</button>
                </div>
            </form>
        </div>
        <div class="fixed-action-btn">
            <a class="btn-floating btn-large teal darken-2">
                <i class="large material-icons">menu</i>
            </a>
            <ul>
                <li><a class="btn-floating blue darken-2 waves-effect waves-light tooltipped" onclick="$('#modal2').modal('open');" data-position="left" data-delay="50" data-tooltip="افزودن"><i class="material-icons">add</i></a></li>
                <li><a class="btn-floating purple waves-effect waves-light tooltipped modal-trigger" onclick="$('#modal1').modal('open');" data-position="left" data-delay="50" data-tooltip="جست و جو"><i class="material-icons">search</i></a></li>
            </ul>
        </div>
        <nav class="teal z-depth-3 darken-2">
            <div class="nav-wrapper" style="text-align:center">
                <a class="title tt center-aligned">اولیا</a>
                <ul id="nav-mobile" class="left hide-on-med-and-down">
                    <li onclick="fadel()" class="waves-effect waves-light"><a><i class="large material-icons">arrow_back</i></a></li>
                </ul>
            </div>
        </nav>
        <table align="center" border="1" class="striped centered" dir="rtl" id="main">
            <thead>
                <tr>
                    <th>شماره</th>
                    <th>نام و نام خانوادگی</th>
                    <th>نام کتاب</th>
                    <th>تاریخ برداشت</th>
                    <th>مدت</th>
                    <th>تمدید</th>
                    <th>تاریخ برگشت</th>
                    <th>حذف</th>
                </tr>
            </thead>
            <?php
                if ($result)  {
                    $rows = mysqli_num_rows($result);
                   
                    $id = 0;
                    for($i = 0; $i < $rows; $i++) {
                        $row = mysqli_fetch_row($result);
                        $yeard = date("Y") * 365;
                        $monthd = date("m") * 30;
                        $day = date("d");
                        $dayte = $yeard + $monthd + $day;
                        if($dayte - $row[4] >= $row[5]*7 && is_null($row[6])) {
                            echo '<tr class="red lighten-4">';
                        }
                        else {
                            echo '<tr>';
                        }
                        echo '<td>'.++$id.'</td>';
                        echo '<td>'.$row[1].'</td>';
                        echo '<td>'.$row[2].'</td>';
                        echo '<td>'.$row[3].'</td>';
                        echo '<td>'.$row[5].' هفته </td>';
                        echo '<td><form action="http://localhost:8080/tsnoghner/" method="post"><input type="text" name="tamdid" value="'.$row[0].'" style="display:none"><button type="submit" class="btn-flat waves-effect waves-orange" style="width:40px;height:40px;padding:0;border-radius:500px"><i class="material-icons" style="color:#ff7700">access_time</i></button></form></td>';
                        if(is_null($row[6])) {
                            echo'<td><form action="http://localhost:8080/tsnoghner/" method="post"><input type="text" name="id" value="'.$row[0].'" style="display:none"><button type="submit" class="btn-flat waves-effect waves-green" style="width:40px;height:40px;padding:0;border-radius:500px"><i class="material-icons" style="color:green">add</i></button></form></td>';
                        }
                        else {
                            echo '<td>'.$row[6].'</td>';
                        }
                        echo'<td><form action="http://localhost:8080/tsnoghner/" method="post"><input type="text" name="del" value="'.$row[0].'" style="display:none"><button type="submit" class="btn-flat waves-effect waves-red" style="width:40px;height:40px;padding:0;border-radius:500px"><i class="material-icons" style="color:red">clear</i></button></form></td>';
                        echo '</tr>';
                    };
                }
            ?>
        </table>
    </body>
</html>