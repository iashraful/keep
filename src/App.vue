<template>
  <div id="app">
  	<ul>
	  <li class="brand"><a href="/#/">Ashraful's Keep</a></li>
	  <li>
	  	<div class="search">
		    <input class="search-input" type="text" placeholder="Search.." name="search">
		 </div>
	  </li>
    <li v-show="!loginState"><a class="active" href="/#/login">Login</a></li>
	  <li v-show="loginState"><a href="/#/logout">Logout</a></li>
	</ul>
    <router-view/>
  </div>
</template>

<script>
export default {
  name: 'app',
  data() {
    return {
      loginState: localStorage.getItem('login') || false
    }
  }
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
}

/* Navbar Design */
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

li {
    float: right;
}
.brand {
	float: left;
}
.search {
	position: absolute;
    left: 38%;
}
.search-input {
	width: 350px;
	padding: 7px;
  margin-top: 8px;
  border: none;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover {
  background-color: #111;
}
</style>
