<template>
    <div>
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
                <li class="active"><router-link :to="{name: 'home'}">Home</router-link></li>
                <li>
                    <router-link :to="{name: 'user'}">User</router-link>
                </li>
                <li><router-link :to="{name: 'about'}">About</router-link></li>
                <li><router-link :to="{name: 'news'}">News</router-link></li>                                       
                <li><a href="#">Blog</a></li>
                <li><a href="#">contact</a></li>
                </ul>
            </div>
        </nav>
         <router-view></router-view>
    </div>
</template>