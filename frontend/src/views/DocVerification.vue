<template>
    <div id="docVerify">
        <img src="../assets/finallogo.png" id="logo" alt="logo">
        <h1>V E R I F I C A T I O N</h1>
        <div class="login_bx">
            <p>Requirements:</p>
            <form action='' method='' >
                <table style="width: 100%"> 
                    <tr>
                        <td><label>Doctor's License </label></td>
                        <td><input type="file"></td>
                    </tr>
                    <tr>
                        <td><label>Board Certification </label></td>
                        <td><input type="file"></td>
                    </tr>
                    <tr>
                        <td><label>Medical School Diploma </label></td>
                        <td><input type="file"></td>
                    </tr>
                    <tr>
                        <td><label>Reference Contacts </label></td>
                        <td><input type="file"></td>
                    </tr>
                </table>
                <input type="submit" value="Submit" name="submit" class="login_sub" @click="verify()"><br>
            </form>
            <router-link to='/Signup'>Go Back</router-link>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Doctor_Verification',
    data() {
        return {
        }
    },
    methods: {
        verify() {
            this.$router.replace({ name: "Login" });
        }
    }
}
</script>

<style scoped>
img {
    margin-top: 3%;
    height: 20%;
    width: 20%;
}
p {
    text-decoration: underline;
}
.login_bx {
    background-color: white;
    border: 5px hidden rgba(0,0,0,0.5);
    border-radius: 25px;
    padding-top: 0.3%;
    padding-left: 0.3%;
    padding-bottom: 1.5%; 
    padding-right: 0.3%;
    margin-top: 1%;
    margin-left: 30%;
    margin-right: 30%;
    margin-bottom: 3%;
}
.login_inp {
    margin-top: 5%;
    width: 70%;
    border-radius: 25px;
    border: 2px solid white; 
    padding: 2%;
    font-size: 17px;
    background-color: #ededed;
}
.login_sub {
    font-size: 17px;
    padding: 2%;
    padding-left: 5%;
    padding-right: 5%;
    background-color: lightblue;
    border-radius: 25px;
    color: black;
    margin-bottom: 5%;
    margin-top: 3%;
    cursor: pointer;
}
td {
    padding: 1%;
}
</style>