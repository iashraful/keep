<template src="../templates/login-template.html"></template>

<script>
	import 'whatwg-fetch';

	export default {
		name: "Login",
		data() {
			return {
				username: "",
				password: "",
				loginState: localStorage.getItem('login') || false,
			}
		},
		methods: {
			submitLogin() {
				const loginUrl = '/api/login.php';
				const payload = {
					method: 'POST',
					headers: {'Content-Type': 'application/json'},
					body: JSON.stringify({
						username: this.username,
						password: this.password
					})
				};
				fetch(loginUrl, payload).then((response) => {
					return response.json();
				}).then((data) => {
					this.loginState = data.login;
					if(data.login) {
						localStorage.setItem('user', String(data.user));
						localStorage.setItem('login', true);
						this.$router.push('/');
					}
				})
			}
		},
		created: function() {
			if (this.loginState) {
				this.$router.push('/');
			}
		}
	}
</script>

<style src="../styles/login-style.css"></style>