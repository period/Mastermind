<template>
  <div class="container">
    <h1>Settings</h1>
    Name: <input v-model="name">
    Allow duplicates in code (true/false): <input v-model="allowDuplicates">
  </div>
</template>

<script>
export default {
    name: "Settings",
    data: function() {
        return {
            name: "Anonymous",
            allowDuplicates: "true"
        };
    },
    mounted() {
        if (localStorage.name != null) {
            this.name = localStorage.name;
        }
        else {
            this.name = "Anonymous"
            localStorage.name = "Anonymous";
        }

        if (localStorage["allow-duplicates"]  != null) {
            this.allowDuplicates = localStorage["allow-duplicates"] ;
        }
        else {
            this.allowDuplicates = true;
            localStorage["allow-duplicates"]  = true;
        }
    },
    watch: {
        name(newName) {
            localStorage.name = newName;
        },
        allowDuplicates(newAllowDupes) {
            localStorage["allow-duplicates"] = (newAllowDupes == "true");
        }
    }
};
</script>
