<template>
    <div id="signup">
		
        <h1>S I G N U P</h1>
        <div class="login_bx">
            <h1>Select Account Type</h1>
            <select v-model="input.type" required>
                <option disabled value="">Please select one</option>
                <option value="Patient">Patient</option>
                <option value="Doctor">Doctor</option>
            </select><br>
            <form>
                <input type="email" class="login_inp" name="email" v-model="input.email" placeholder="Email" required /><br>
                <input type="text" class="login_inp" name="username" v-model="input.username" placeholder="Username" required /><br>
                <input type="text" class="login_inp" name="address" v-model="input.address" placeholder="Address" required /><br>
                <input type="password" class="login_inp" name="password" v-model="input.password" placeholder="Password" minlength="8" required /><br>
                <input type="password" class="login_inp" name="rep_pass" v-model="input.rep_pass" placeholder="Confirm Password" minlength="8" required /><br>
                <input type="submit" class="login_sub" @click="signup()" value="Sign Up">
            </form>
            <p>Already have an account? <router-link to='/login'>Login here !</router-link></p>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Signup',
    data() {
        return {
            input: {
                email: "",
                username: "",
                address: "",
                password: "",
                rep_pass: "",
                type: ""
            }
        }
    },
    methods: {
        signup() {
            if(this.input.username != "" && this.input.password != "" && this.input.email != "" && this.input.address != "" && this.input.rep_pass != "" && this.input.type != "") {
                if(this.input.password.length >= 8 && this.input.password == this.input.rep_pass) {
                    if(this.input.type === "Patient") {
                        this.$router.replace({ name: "Login" });
                    } else if (this.input.type === "Doctor") {
                        this.$router.replace({ name: "DocVerify" });
                    } 
                } else {
                    alert("Password and repeat password should match. Please try again");
                    this.$router.replace({ name: "Signup" });
                }
            } else {
                alert("Please fill out all required details");
                // this.input.email = "";
                // this.input.username = "";
                // this.input.address = "";
                // this.input.password = "";
                // this.input.rep_pass = "";
                // this.input.type = "";
                this.$router.replace({ name: "Signup" });
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