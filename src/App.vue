<template>
  <div id="app">
  	<ul>
  	  <li class="brand"><a href="/#/">Ashraful's Keep</a></li>
  	  <li>
  	  	<div class="search">
          <form v-on:submit.prevent="handleSearch">
  		      <input class="search-input" type="text" placeholder="Search.." v-model="q">
  		    </form>
       </div>
  	  </li>
      <li v-show="!loginState"><a class="active" href="/#/login">Login</a></li>
  	  <li v-show="loginState"><a href="/#/logout">Logout</a></li>
  	</ul>
    <router-view/>
  </div>
</template>

<script>
import Vue from 'vue';
window.Event = new Vue();

export default {
  name: 'app',
  data() {
    return {
      loginState: localStorage.getItem('login') == 'true' ? true : false,
      q: ""
    }
  },
  methods: {
    handleSearch() {
      this.$router.push({ path: '/', query: { q: this.q }});
      Event.$emit('q-changed');
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
  margin-top: 5px;
	position: absolute;
  left: 38%;
}
.search-input {
	width: 350px;
	padding: 7px;
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
