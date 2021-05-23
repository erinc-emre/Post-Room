<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="widt=device-width, inital-scale=1.0">
    <title> Create New Room </title>
</head>
<body>  
    <section class="main">
        <nav>
        <a href="#" class="logo">
            <img src="images/logo1.png"/>
            </a>
            
            <ul class="menu">
                <li><a href="#" class="active">Home</a></li>
                <li><a href="#" >Account Settings</a></li>
                <li><a href="#" >Exit</a></li>
            </ul>
        </nav> 
        <div class="main-heading">
            <h1>Create New Room</h1>
            <form action="createNewRoom.php" method="post">
                <label for="roomName">RoomName</label>
                <input type="text" name="roomName" placehoder ="Name of the Room">
                <label for="descripton">Description</label>
                <textarea name="description" placehoder ="Description of the Room"></textarea>
                <button class="main-btn newroom-btn" type="submit">Create</button>
            </form>





            </div>

    </section>
</body>
