<template src="../templates/home-template.html"></template>


<script>
    export default {
        name: "Home",
        data() {
            return {
            		authenticated: true,
                // authenticated: localStorage.getItem('login') == 'true' ? true : false
                note: "",
                notes: [],
            }
        },
        methods: {
        	noteSubmit() {
        		const apiUrl = '/api/keeps.php';
				const payload = {
					method: 'POST',
					headers: {'Content-Type': 'application/json'},
					body: JSON.stringify({
						note: this.note
					})
				};
				fetch(apiUrl, payload).then((response) => {
					return response.json();
				}).then((data) => {
					this.notes.unshift(data);
                    this.note = "";
				})
        	},
        	triggerCheckbox(id) {
        		let isChecked = data.is_checked == 1 ? 0 : 1;
        	}
        },
        created() {
        	// This will trigger when this component will mount.
        	// Here will fetch all the notes from server
        	const apiUrl = '/api/keeps.php';
			const payload = {
				method: 'GET',
				headers: {'Content-Type': 'application/json'},
			};
			fetch(apiUrl, payload).then((response) => {
				return response.json();
			}).then((data) => {
				this.notes = data;
			})
        }
    }
</script>

<style src="../styles/home-style.css"></style>
