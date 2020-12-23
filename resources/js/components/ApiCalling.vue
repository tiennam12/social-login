<template>
    <div class="api-calling">
        <div class="create-form">
            <div class="form-group">
                <label class="col-sm-3 control-label">Full Name</label>
                <div class="col-sm-9">
                    <input v-model="user.user_name" type="text" id="user_name" name="user_name" placeholder="Full Name" class="form-control" autofocus>
                </div>
            </div>
            <div class="form-group">
                <label id="email_label" for="email" class="col-sm-3 control-label">Email</label>
                <div class="col-sm-9">
                    <input v-model="user.email" name="email" type="email" id="email" placeholder="Email" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label for="firstName" id="username_label" class="col-sm-3 control-label">User Name</label>
                <div class="col-sm-9">
                    <input type="text" id="fullName" name="user_name" placeholder="User Name" class="form-control" autofocus required>
                </div>
            </div>
            <div class="form-group">
                <label id="password_label" for="password" class="col-sm-3 control-label">Password</label>
                <div class="col-sm-9">
                    <input v-model="user.password" type="password" name="password" id="password" placeholder="Password" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-sm-3 control-label">Password</label>
                <div class="col-sm-9">
                    <input v-model="user.password_confirmation" type="password" name="password" id="password_confirmation" placeholder="Password" class="form-control" required>
                </div>
            </div>

            <div class="form-group">
                <label for="avatar" class="col-sm-3 control-label">Choose a profile picture:</label>
                <input @change="onFileChange"  style="padding-left: 20px" type="file" id="avatar" name="avatar"  required>
<!--                <div id="preview" style="padding-left: 305px; padding-top: 16px"></div>-->
            </div>
            <div id="preview">
                <img v-if="url" :src="url" />
            </div>

            <div class="form-group">
                <label id="gender_label" class="control-label col-sm-3">Gender</label>
                <div class="col-sm-6">
                    <div class="row" id="gender" style="padding-left: 5px">
                        <div class="col-sm-4">
                            <label class="radio-inline" id="femaleRadio_label">
                                <input v-model="user.gender" type="radio" name="gender" id="femaleRadio" value="Female">Female
                            </label>
                        </div>
                        <div class="col-sm-4">
                            <label class="radio-inline">
                                <input v-model="user.gender" type="radio" name="gender" id="maleRadio" value="Male">Male
                            </label>
                        </div>
                        <div class="col-sm-4">
                            <label class="radio-inline">
                                <input v-model="user.gender" type="radio" name="gender" id="unknownRadio" value="Unknown">Unknown
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="button-create">
                <button @click="createUser">Create</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            user: {
                name: '',
                user_name: '',
                email:'',
                gender:'',
                password:'',
                password_confirmation: '',
                avatar: ''
            },
        }
    },
    methods: {
        createUser() {
            axios.post('/api/users', {name: this.user.name, user_name: this.user.user_name,  email:this.user.email, gender:this.user.gender, avatar:this.user.avatar, password:this.user.password, password_confirmation:this.user.password_confirmation})
                .then(response => {
                    console.log(response.data.user)
                })
                .catch(error => {
                    console.log(error)
                })
        }
    }
}

const vm = new Vue({
    el: '#app',
    data() {
        return {
            url: null,
        }
    },
    methods: {
        onFileChange(e) {
            const file = e.target.files[0];
            this.url = URL.createObjectURL(file);
        }
    }
})
</script>

<style lang="scss" scoped>
</style>
