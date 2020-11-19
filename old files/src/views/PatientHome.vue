<template>
    <img src='../assets/logopatient.png' alt="logo" class="logosmall">
    <h1>Patient Home</h1><br>
    <button class="tablink" @click="openPage('Profile', this, 'white')" id="defaultOpen">P R O F I L E</button>
    <button class="tablink" @click="openPage('Appointments', this, 'white')">A P P O I N T M E N T S</button>
    <button class="tablink" @click="openPage('Patient_Records', this, 'white')">M E D I C A T I O N</button>
    <button class="tablink" @click="openPage('Config', this, 'white')">C O N F I G U R A T I O N</button>
</template>

<script>
export default {
    name: 'PatientHome',
    data() {
        return {
        }
    },
    methods: {
        openPage(pageName,elmnt,color) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablink");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].style.backgroundColor = "";
            }
            document.getElementById(pageName).style.display = "block";
            elmnt.style.backgroundColor = color;
            if (pageName !== "Patient_Records") {
                var hide = document.getElementById("Patient_Records");
                hide.style.display = "none";
            }
        }
    }
}
</script>

<style scoped>
.logosmall{
	height: 10%;
	width: 10%;
    float: left;
    margin-left: 1%;
    margin-top: 1%;
}
.tablink {
    background-color: #ffd59a;
    color: black;
    float: left;
    border-top-left-radius: 25px;
    border-top-right-radius: 25px;
    border-bottom: 0;
    cursor: pointer;
    padding: 14px 16px;
    font-size: 17px;
    width: 25%;
}
</style>

