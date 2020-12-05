<template>
    <div>
        <img src='../assets/finallogo.png' alt="logo">
        <div id="login">
            <h1>L O G I N</h1>
            <div class="login_bx">
                <form>
                    <input type="text" class="login_inp" name="username" v-model="input.username" placeholder="Username" /><br>
                    <input type="password" class="login_inp" name="password" v-model="input.password" placeholder="Password" /><br>
                    <input type="submit" class="login_sub" @click="login()" value="Login">
                </form>
                <p>No account yet? <router-link to='/Signup'>Sign up here !</router-link></p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Login',
    data() {
        return {
            input: {
                username: "",
                password: ""
            }
        }
    },

    methods: {
        login() {
            if(this.input.username != "" && this.input.password != "") {
                if(this.input.username == this.$parent.mockAccount1.username && this.input.password == this.$parent.mockAccount1.password) {
                    this.$emit("authenticated", true);
                    this.$router.replace({ name: "PatientHome" });
                } else if (this.input.username == this.$parent.mockAccount2.username && this.input.password == this.$parent.mockAccount2.password){
                    this.$emit("authenticated", true);
                    this.$router.replace({ name: "DocHome" });
                } else {
                    alert("The username and / or password is incorrect");
                }
            } else {
                alert("A username and password must be present");
            }
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
.login_bx {
    background-color: white;
    border: 5px hidden rgba(0,0,0,0.5);
    border-radius: 25px;
    padding-top: 0.3%;
    padding-left: 0.3%;
    padding-bottom: 1.5%; 
    padding-right: 0.3%;
    margin-top: 1%;
    margin-left: 35%;
    margin-right: 35%;
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
    padding-left: 10%;
    padding-right: 10%;
    background-color: lightblue;
    border-radius: 25px;
    color: black;
    margin-bottom: 5%;
    margin-top: 3%;
    cursor: pointer;
}
a {
    color:darkblue;
}
a:active {
    color: red;
}
</style>