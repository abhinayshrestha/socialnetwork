<?php
   require "signup.php";
   require "login.php";
   if(isset($_SESSION['id']) and !empty($_SESSION['id'])){
	   header('Location: home.php');
   }
?>
<html>
    <head>
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css./index.css">
        <link rel="stylesheet" href="fonts/css/font-awesome.min.css">
		<link rel="icon" href="webimages/icon.png">
        <script src="js/jquery.js"></script>
    </head>
<body>
    <div id="header">
        <a id="logo" href="index.php">< KccConnection /></a>
        <a id="about" href="#">About Us</a>
    </div>
    <div id="form-container">
  <div class="login form">
      <div class="formheader">
          <i class="fa fa-user"></i><h3>Login</h3>
          <span>See what's going on your college today
          </span>
      </div>
  <form id="loginform" method="post" action="index.php">
     <div class="group">      
         <input type="text" name="lid" id="lid" maxlength="15" value="<?php
	 if(isset($lid)){echo $lid;} ?>">
         <div id="liderror">Enter Your 8 or 9 Character ID Number</div>
      <span class="highlight"></span>
      <span class="bar"></span>
         <label><i class="fa fa-user"></i> &nbspID Number</label>
    </div>
      <div class="group">      
          <input type="password" name="lpassword" id="lpassword" maxlength="30"><div id="lpassworderror">Enter Your Correct Password For Security Issue</div><div id="loginerror">The username or password you typed is invalid</div>
      <span class="highlight"></span>
      <span class="bar"></span>
      <label><i class="fa fa-eye"></i> &nbspPassword</label>
    </div>
      <button id="loginsubmit" class="button" name="login" value="login">
          Login &nbsp&nbsp<i class="fa fa-lock"></i>
      </button>
      <button id="teacherlogin" class="button">
          Login as Teacher &nbsp&nbsp<i class="fa fa-user-plus"></i>
      </button>
      <button id="adminlogin" class="button">
          Login as Admin &nbsp&nbsp<i class="fa fa-amazon"></i>
      </button>
      <a href="#"><i class="fa fa-question-circle"> &nbspForgot Password</i></a>
   </form>
  </div>
    <div class="signup form">
      <div class="formheader">
          <i class="fa fa-pencil"></i><h3>Signup</h3>
          <span>Be a part of your college Community
          </span>
      </div>
        <form id="signupform" method="post" action="index.php">
            <table border="0px" cellspacing="5">
                <tr><td><input type="text" class="text" placeholder="First name" id="fname" name="fname" value="<?php
	            if(isset($fname)){echo $fname;} ?>" maxlength="20"><div class="lerrormsg" id="fnameerror">Your First Name</div></td><td><input type="text" class="text" placeholder="Last name" id="lname" name="lname" value="<?php
	             if(isset($lname)){echo $lname;} ?>" maxlength="20"><div class="rerrormsg" id="lnameerror">Your Last Name</div></td>
                </tr>
                <tr><td colspan="2" style="padding-left: 10px">Gender <input type="radio" name="gender" value="Male" checked="checked"> Male <input type="radio" name="gender" value="Female"> Female</td>
                </tr>
                <tr><td colspan="2" style="padding-left: 10px">Date of Birth 
                <select id="year" name="year"><option value="2000" name="year">2000</option><option value="1999">1999</option><option value="1998">1998</option>
		        <option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option>
		        <option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option>
		        <option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option>
		        <option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option>
		        <option value="1981">1981</option><option value="1980">1980</option><option value="1979">1979</option><option value="1978">1978</option>
		        <option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option>
		        <option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option>
		        <option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option>
		         <option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option>
		        <option value="1961">1961</option><option value="1960">1960</option><option value="1959">1959</option><option value="1958">1958</option>
		        <option value="1957">1957</option><option value="1956">1956</option><option value="1955">1955</option><option value="1954">1954</option>
		        <option value="1953">1953</option><option value="1952">1952</option><option value="1951">1951</option><option value="1950">1950</option></select>           
                <select id="month" name="month"><option value="1">Jan</option><option value="2">Feb</option><option value="3">Mar</option><option value="4">Apr</option>
		        <option value="5">May</option><option value="6">Jun</option><option value="7">Jul</option><option value="8">Aug</option><option value="9">Sep</option><option value="10">Oct</option><option value="11">Nov</option><option value="12">Dec</option>
                </select>
                <select id="day" name="day"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
		        <option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option>
		        <option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option>
		        <option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option>
		        <option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option>
		        <option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option>
		        <option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option>
		        <option value="30">30</option><option value="31">31</option>
                </select></td></tr>
                <tr><td><select class="opt" name="faculty" id="faculty"><option value="">Faculty</option><option value="B.E Computer">B.E Computer</option><option value="BIT">BIT</option><option value="BCA">BCA</option>
                </select><div id="facultyerror" class="lerrormsg">Select Your Faculty</div></td>
                <td><select class="opt" id="semester" name="semester"><option value="">Semester</option><option value="I">I</option><option value="II">II</option><option value="III">III</option><option value="IV">IV</option><option value="V">V</option><option value="VI">VI</option><option value="VII">VII</option><option value="VIII">VIII</option>
                </select><div class="rerrormsg" id="semestererror">Select Your Semester</div></td></tr>
                <tr><td><select class="opt" name="id" id="id"><option value="">ID</option></select><div class="lerrormsg" id="iderror">Select Your Correct Id Number</div></td></tr>
                <tr><td><input type="password" name="password" id="rpassword" class="text" placeholder="Password" maxlength="30"><div class="lerrormsg" id="spassworderror">Password Must Contain Atleast<br>Five Character and a number </div></td><td><input type="text" id="email" name="email" class="text" placeholder="Gmail" value="<?php
	    if(isset($email)){echo $email;} ?>" maxlength="50"><div class="rerrormsg" id="emailerror">Enter a Valid Email<br>That Will Be Used To Recover Your Password</div></td></tr>
                <tr><td colspan="2" ><center><button class="button" id="signupsubmit" name="signup" value="signup">Sign Up &nbsp<i class="fa fa-arrow-circle-right"></i></button></center></td></tr>
            </table>
        </form>
  </div>
    </div>
    <footer>KccConnection &copy 2018</footer>
<script>     
    $(document).ready(function(){
        $('#lid').focus();
        $('.signup .formheader').click(function(){
            $(this).addClass('move');
            $('#signupform').addClass('f');
            $('#liderror').hide();
            $('#lpassworderror').hide();
            $('#fname').focus();
        });
        $('.login .formheader').click(function(){
            $('.signup .formheader').removeClass('move');
            $('#signupform').removeClass('f');
            $('.rerrormsg').hide();
            $('.lerrormsg').hide();
            $('#lid').focus();
        });
        $('#teacherlogin').click(function(e){
            e.preventDefault();
            return false;
        });
        $('#adminlogin').click(function(e){
            e.preventDefault();
            return false;
        });
        $('#loginform').on('submit',function(e){
            var liderror=false;
            var lpassworderror=false;
            var lid=$('#lid').val();
            var lpassword=$('#lpassword').val();
            if(lid.length>=8){
               liderror=true;
            }
            if(lpassword.length>2){
                lpassworderror=true;
            }
            if(liderror==true && lpassworderror==true){
                return true;
            }
            else{
                if(liderror==false){
                    $('#liderror').fadeIn(200);
                }
                 if(lpassworderror==false){
                    $('#lpassworderror').fadeIn(200);
                }
                return false;
            }
        });
         $('#lid').focusin(function(){
                $('#liderror').fadeOut(200);
         });
        $('#lpassword').focusin(function(){
                $('#lpassworderror').fadeOut(200);
         });
        if(<?php echo $loginerror ?> > 0){
             $('#loginerror').show();        
        }
        else{
            $('#loginerror').hide();
        }
        $('#faculty').change(function(){
            var faculty=$('#faculty option:selected').val();
            var semester=$('#semester option:selected').val();
            if(semester.length>0 && faculty.length>0){
                getId(faculty,semester);
            }
            else{
                $('#id').html('<option value="">ID</option>');
            }
        });
         $('#semester').change(function(){
            var faculty=$('#faculty option:selected').val();
            var semester=$('#semester option:selected').val();
             if(faculty.length>0 && semester.length>0){
                getId(faculty,semester);
             }
             else{
                $('#id').html('<option value="">ID</option>');
            }
        });
        $('#signupform').on('submit',function(){
           var fnameerror=false;
           var lnameerror=false;
           var facultyerror=false;
           var semestererror=false;
           var iderror=false;
           var passworderror=false;
           var emailerror=false;
            var fname=$('#fname').val();
            var lname=$('#lname').val();
            var faculty=$('#faculty option:selected').val();
            var semester=$('#semester option:selected').val();
            var id=$('#id option:selected').val();
            var password=$('#rpassword').val();
            var email=$('#email').val();
            var nameReg= /^[a-zA-Z\s]+$/;
			if(nameReg.test(fname) && fname.length>2){
			   fnameerror=true;
	    	}
            else{
                $('#fnameerror').fadeIn(200);
                $('#fname').css('border-bottom','1px solid red');
            }
            if(nameReg.test(lname) && lname.length>2){
			   lnameerror=true;
	    	}
            else{
                $('#lnameerror').fadeIn(200);
                $('#lname').css('border-bottom','1px solid red');
            }
            if(faculty.length>0){
                facultyerror=true;
            }
            else{
                $('#facultyerror').fadeIn(200);
                $('#faculty').css('border','1px solid red');
            }
            if(semester.length>0){
                semestererror=true;
            }
            else{
                $('#semestererror').fadeIn(200);
                $('#semester').css('border','1px solid red');
            }
            if(id.length>0){
               iderror=true;
            }
            else{
                $('#iderror').fadeIn(200);
            }
            var passwordReg=/(?=.*[0-9])/;
            if(passwordReg.test(password) && password.length>5){
               passworderror=true;
            }
            else{
                $('#spassworderror').fadeIn(200);
                $('#rpassword').css('border-bottom','1px solid red');
            }
            emailReg=/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
			if(emailReg.test(email)){
			   emailerror=true;
			}
            else{
                $('#emailerror').fadeIn(200);
                $('#email').css('border-bottom','1px solid red');
            }
            if(fnameerror==true && lnameerror==true && semestererror==true && passworderror==true && emailerror==true && iderror==true)
			{
			   return true;
			}
            else{
                return false; 
            }
        });
        $('#fname').focusin(function(){
            $('#fnameerror').hide();
            $('#fname').css('border-bottom','1px solid #00b300');
        });
        $('#lname').focusin(function(){
            $('#lnameerror').hide();
            $('#lname').css('border-bottom','1px solid #00b300');
        });
        $('#semester').focusin(function(){
            $('#semestererror').hide();
            $('#semester').css('border','1px solid #ccc');
        });
        $('#faculty').focusin(function(){
            $('#facultyerror').hide();
            $('#faculty').css('border','1px solid #ccc');
        });
        $('#id').focusin(function(){
            $('#iderror').hide();
        });
        $('#rpassword').focusin(function(){
            $('#spassworderror').hide();
            $('#rpassword').css('border-bottom','1px solid #00b300');
        });
        $('#email').focusin(function(){
            $('#emailerror').hide();
            $('#email').css('border-bottom','1px solid #00b300');
        });
        if(<?php echo $error ?>>0){
		     $('#iderror').fadeIn(200);      
		 }
      });
       function getId(faculty,semester){
           $.ajax({
               url : 'id_finder.php',
               method : 'POST',
               dataType : 'text',
               data : {
                   getId : 1,
                   semester : semester,
                   faculty : faculty
               },
               success : function (data){
                   $('#id').html(data);
               }
           });
       }
    </script>    
</body>
</html>    