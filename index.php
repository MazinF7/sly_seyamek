<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css ?">
    <link rel="shortcut icon" href="logo.jpeg" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سلي صيامك</title>
</head>
<body>
    <div class="anm1"></div>
    <div class="checkuser" id="checkuser">
        <form method="post">
            <Input id="username" name="username" type="text" placeholder="ادخل اسم المستخدم للتحق منه ">
            <Input id="password" type="password" name="password" placeholder="ادخل كلمة مرور خاصة بك " >
            <button id="submit" name="submit">تحقق</button>
            <p dir="rtl">اذا لم يكن لديك حساب يرجى <a href="#" target="_blank">تسجيل دخول</a></p>
    </div>
    <div class="champion_body" id="champion_body">
        <div class="qustion" dir="rtl">عدد السور التى اول ما فيها "الحمدلله " ؟</div>
        <div class="all_answer" id="all_answer">
        <button class="answer1" name="right">4</button>
        <input  value="4" name="answer1input" hidden>
        <button class="answer2" name="wrong">5</button>
        <input  value="5" name="answer2input" hidden>
        <button class="answer3" name="wrong">6</button>
        <input  value="6" name="answer3input" hidden>
        <button class="answer4" name="wrong">7</button>
        <input  value="7" name="answer4input" hidden>
</form>
        <div class="counter" id="counter"></div>
        </div>
        <div class="rightanswerifwrong" id="wronganswer" style="color:red;"></div>
        <div class="time" id='time' style="color:red;"></div>
        <div class="rightanswer" id="rightanswer" style="color:green;"></div>
    </div>
    <div class="anm2"></div>
    <script src="mai.js"></script>
    <?php
    require('database/db.php');
    if (isset($_POST['wrong'])){
        $username= stripslashes($_REQUEST['username']);
        $username= mysqli_real_escape_string($con, $username);
        $time= date("Y-m-d H:i:s");
        $query ="INSERT into `answers` (username, answer,time)
                    VALUES ('$username', 'wrong','$time')";
                    $result   = mysqli_query($con, $query);
                    if($result){
                        echo"
                        <script>
                    let checkuser=document.getElementById('checkuser');
                    let champion_body=document.getElementById('champion_body');
                    let wronganswer=document.getElementById('wronganswer');
                    let all_answer=document.getElementById('all_answer');
                    checkuser.style.display='none';
                    champion_body.style.display='block';
                    all_answer.style.display='none';
                    wronganswer.innerHTML='اجابة خطا لمعرفة الاجابة الصحيحة يرجى متابعة صفحتنا على فيسبوك لمعرفة اجابة صحيحة و ترتيب';
                    </script>
                        ";
                    }
                    else{
                        echo"
                        <script>
            alert(' حدث خطا ما يرجى التواصل معا لحل مشكلة')
            </script>
                        ";
                    }
    }
    ?>
    <?php
    require('database/db.php');
    if (isset($_POST['right'])){
        $username= stripslashes($_REQUEST['username']);
        $username= mysqli_real_escape_string($con, $username);
        $time= date("Y-m-d H:i:s");
        $query ="INSERT into `answers` (username, answer,time)
                    VALUES ('$username', 'right','$time')";
                    $result   = mysqli_query($con, $query);
                    if($result){
                        echo"
                        <script>
                    let checkuser=document.getElementById('checkuser');
                    let champion_body=document.getElementById('champion_body');
                    let rightanswer=document.getElementById('rightanswer');
                    let all_answer=document.getElementById('all_answer');
                    checkuser.style.display='none';
                    champion_body.style.display='block';
                    all_answer.style.display='none';
                    rightanswer.innerHTML='اجابة صحيحة  يرجى متابعة صفحتنا على فيسبوك لمعرفة  ترتيب';
                    </script>
                        ";
                    }
                    else{
                        echo"
                        <script>
            alert(' حدث خطا ما يرجى التواصل معا لحل مشكلة')
            </script>
                        ";
                    }
    }
    ?>
    <?php
        require('database/db.php');
        if (isset($_POST['submit'])){
            $username= stripslashes($_REQUEST['username']);
        $username= mysqli_real_escape_string($con, $username);
        $password= stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $time= date("Y-m-d H:i:s");
        $query    = "SELECT * FROM `all_users` WHERE username='$username' AND password='$password'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if($rows==1){
            $query    = "SELECT * FROM `answers` WHERE username='$username' AND answer=''";
            $result = mysqli_query($con, $query) or die(mysql_error());
            $rows2 = mysqli_num_rows($result);
            if($rows2==1){
                echo"
            <script>
            alert('لا يمكن دخول مره ثانية')
            </script>
            ";
            }
            else{
             $query ="INSERT into `answers` (username, answer,time)
                    VALUES ('$username', '','$time')";
                    $result   = mysqli_query($con, $query);
                    if($result){
                        echo"
                    <script>
                    let checkuser=document.getElementById('checkuser');
                    let champion_body=document.getElementById('champion_body');
                    checkuser.style.display='none';
                    champion_body.style.display='block';
                    let counter=document.getElementById('counter');
                    let num=20;
                    let time=document.getElementById('time');
                    function count(){
                        num--;
                        counter.innerHTML=num;
                        if(num==0){
                            let all_answer=document.getElementById('all_answer');
                            all_answer.style.display='none';
                            time.innerHTML='نفذ الوقت يرجى متابعة صفحتنا على فيسبوك لمعرفة الاجابة الصحيحة';
                        }
                        else{
                        setTimeout(count,1000)
                        }
                    }
                    count();
                    </script>
                    ";
                    }
                }
            //
        }
        else{
            echo"
            <script>
            alert(' يرجى تحقق  من اسم مستخدم و كلمة مرور')
            </script>
            ";
        }
    }
        ?>
</body>
</html>