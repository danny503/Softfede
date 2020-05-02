<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Menu</a>
    </div>
        <div class="collapse navbar-collapse js-navbar-collapse">
            <ul class="nav navbar-nav">
            <li class="active"><a href="#" @click="navbar=0">Home</a></li>
            <li>
                <a href="#" @click="navbar=0">User</a>
            </li>
            <li><a href="#" @click="navbar=1">About</a></li>
            <li><a href="#" @click="navbar=2">News</a></li>                                       
            <li><a href="#">Blog</a></li>
            <li><a href="#">contact</a></li>
            </ul>
        </div>
    </nav>