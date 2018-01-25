<template src="../templates/home-template.html"></template>


<script>
    export default {
        name: "Home",
        data() {
            return {
            	// authenticated: true,
                authenticated: localStorage.getItem('login') == 'true' ? true : false,
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
                let note = this.getObjectwithId(id);
                let isChecked = note.is_checked == 1 ? 0 : 1;

                const noteObj = {
                    id: note.id,
                    note: note.note,
                    is_checked: isChecked
                };

                // Update the Note
                const apiUrl = '/api/keeps.php';
                const payload = {
                    method: 'PUT',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify(noteObj)
                };
                fetch(apiUrl, payload).then((response) => {
                    return response.json();
                }).then((data) => {
                	console.log(data);
                    this.updateObjectwithId(note.id, isChecked);
                })
        	},
            getObjectwithId(id) {
                for (let n=0; n<this.notes.length; n++) {
                    if(id == this.notes[n].id) {
                        return this.notes[n]
                    }
                }
            },
            updateObjectwithId(id, checked) {
                for (let n=0; n<this.notes.length; n++) {
                    if(id == this.notes[n].id) {
                        this.notes[n].is_checked = checked;
                        break
                    }
                }
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
