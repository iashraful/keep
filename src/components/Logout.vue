<template>
	<div>
		<h2 class="text-center">Successfully Logout.</h2>
	</div>
</template>

<script>
	/**
	* Logout concept is so simple. There is no Logout API I have. So, I'll remove user from\
	local storage and will set login false
	*/
	export default {
		name: "Logout",
		created: function() {
			if(localStorage.getItem('login') == 'true') {
				localStorage.setItem('user', "");
				localStorage.setItem('login', 'false');
				// this.$router.push('/login');
				window.location = "/"
			}
			else {
				// this.$router.push('/login');
				window.location = "/"
			}
		}
	}
</script>