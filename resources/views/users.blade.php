    <!doctype html>
    <html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
        <h2 class="text-center mt-3"> SignUp </h2>
        <form action="users" method="post">
            @csrf
        <div class="container">
    <div class="form-group">
        <label for=""> First Name </label>
        <input type="text" class="form-control" name="first_name" id="" aria-describedby="emailHelpId" placeholder="">
    </div>
    <div class="form-group">
        <label for=""> Last Name </label>
        <input type="text" class="form-control" name="last_name" id="" aria-describedby="emailHelpId" placeholder="">
    </div>
    <div class="form-group">
        <label for=""> Email </label>
        <input type="email" class="form-control" name="email" id="" aria-describedby="emailHelpId" placeholder="">
    </div>
    <div class="form-group">
        <label for=""> Password </label>
        <input type="password" class="form-control" name="password" id="" aria-describedby="emailHelpId" placeholder="">
    </div>
    <div class="form-group">
        <label for=""> Confirm Password </label>
        <input type="password" class="form-control" name="confirm_password" id="" aria-describedby="emailHelpId" placeholder="">
    </div>
    <div class="form-group">
        <label for=""> Phone </label>
        <input type="phone" class="form-control" name="phone" id="" aria-describedby="emailHelpId" placeholder="">
    </div>
    <div class="form-group">
        <label for=""> Post Code </label>
        <input type="text" class="form-control" name="post_code" id="" aria-describedby="emailHelpId" placeholder="">
    </div>
    <div class="form-group">
        <label for=""> Country </label>
        <select class="form-control" name="country" id="">
        <option value="Pakistan"> Pakistan </option>
        <option value="Turkey"> Turkey </option>
        <option value="Indonesia"> Indonesia </option>
        </select>
    </div>
    <div class="form-check">
        <label class="form-check-label">
        <input type="radio" class="form-check-input" name="user_type" id="" value="checkedValue" checked>
        Customer
        </label>
    </div>
    <div class="form-check">
        <label class="form-check-label">
        <input type="radio" class="form-check-input" name="user_type" id="" value="checkedValue">
        Seller
        </label>
    </div>
    <div class="form-check">
        <label class="form-check-label">
        <input type="radio" class="form-check-input" name="user_type" id="" value="checkedValue">
        Professional
        </label>
    </div>
    <button class="btn btn-primary mt-4"> Sign Up </button>
    </div>
    </form>
    </body>
    </html>