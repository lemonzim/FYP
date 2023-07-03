<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Register</title>
    <style>
      body{
        height:100%;
      }
       #kotak-tengah{
         border-radius: 50px;
         background-color: white;
         width: 30%;
         margin:auto; /* Center the div */
         position:relative;
         padding: 10px;
         border: solid #30b762;
        }
        h1{
            display:flex;
            align-items: center;
            justify-content: center;
            color: #30b762;
        }
    </style>
    <script>
    function validateform()
{
	var id= document.register.id.value;
	var firstname= document.register.name.value;
	var email= document.register.email.value;
	var password= document.register.password.value;
	var phone= document.register.phone.value;
	
	if(id=null||id=="")
	{
		alert("Student Id can't be blank");
		return false;
	}
	else if(firstname=null||firstname=="")
	{
		alert("First Name can't be blank");
		return false;
	}
	else if(lastname=null||lastname=="")
	{
		alert("Last Name can't be blank");
		return false;
	}
	else if(email=null||email=="")
	{
		alert("Email can't be blank");
		return false;
	}
    else if(password=null||password=="")
	{
		alert("Password can't be blank");
		return false;
	}
     else if(phone=null||phone=="")
	{
		alert("Phone Number can't be blank");
		return false;
	}
}
    </script>
  </head>
    <body>
    <h1>Student Registration</h1>
        <div id="kotak-tengah">
        <form name="register"action="add_student.php" method = "post" onsubmit="return validateform()">
        <div class="mb-3">
        <label for="id" class="form-label">Student ID:</label>
        <input type="number" class="form-control" name="id">
        </div>
        <div class="mb-3">
        <label for="name" class="form-label">Name:</label>
        <input type="text" class="form-control" name="name">
        </div>
        <div class="mb-3">
        <label for="email" class="form-label">Email:</label>
        <input type="text" class="form-control" name="email">
        </div>
        <div class="mb-3">
        <label for="password" class="form-label">Password:</label>
        <input type="password" class="form-control" name="password">
        </div>  
        <div class="mb-3">
        <label for="phone" class="form-label">Phone Number:</label>
        <input type="number" class="form-control" name="phone">
        </div>   
        <input type="submit" class="btn btn-primary" value="Register">
        <button type="button"  class="btn btn-dark"><a href="loginpage.php">Back</a></button>
        </form>
    </div>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js'></script>
    </body>
</html>