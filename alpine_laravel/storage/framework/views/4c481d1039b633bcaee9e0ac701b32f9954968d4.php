<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>CRUD Application with Alpine.js</title>
</head>
<body>
    <div class="container-fluid mt-5" x-data="userCrud()">
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-header text-light bg-info">
                        Users Table
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead class="thead">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template x-for="(user,index) in users" :key="index">
                                    <tr>
                                        <td x-text="index+1"></td>
                                        <td x-text="user.name"></td>
                                        <td x-text="user.email"></td>
                                        <td x-text="user.password"></td>
                                        <td>
                                            <button @click.prevent="editData(user,index)"
                                                class="btn btn-info">Edit</button>
                                            <button @click.prevent="deleteData(index)"
                                                class="btn btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-header text-light bg-info">
                        <span x-show="addMode">Create User</span>
                        <span x-show="!addMode">Edit User</span>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="saveData" x-show="addMode">
                            <div class="form-group">
                                <label>Name</label>
                                <input x-model="user.name" type="text" class="form-control" placeholder="Enter Name">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input x-model="user.email" type="text" class="form-control" placeholder="Enter Email">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input x-model="user.password" type="text" class="form-control" placeholder="Enter your password">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                        <form @submit.prevent="updateData" x-show="!addMode">
                            <div class="form-group">
                                <label>Name</label>
                                <input x-model="form.name" type="text" class="form-control" placeholder="Enter Name">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input x-model="form.email" type="text" class="form-control" placeholder="Enter Email">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input x-model="form.password" type="text" class="form-control" placeholder="Enter password">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function userCrud() {
            return {
                addMode: true,
                id: '',
               user: {
                    name: '',
                    email: '',
                    password: '',
                },
                users: [{
                    name: 'test',
                    email: 'test@mail.com',
                    password: 'password'
                }],
                saveData() {
                    if (this.form.name.length && this.form.email.length) {
                        this.students.push({
                            name: this.form.name,
                            email: this.form.email
                        })
                        this.resetForm()
                    }
                },
                editData(student, index) {
                    this.addMode = false
                    this.form.name = student.name
                    this.form.email = student.email
                    this.id = index
                },
                updateData() {
                    if (this.form.name.length && this.form.email.length) {
                        this.students.splice(this.id, 1, {
                            name: this.form.name,
                            email: this.form.email,
                        })
                        this.resetForm()                    
                    }
                },
                deleteData(index) {
                    this.students.splice(index, 1)
                },
                cancelEdit(){
                    this.resetForm()
                },
                resetForm() {
                    this.form.name = ''
                    this.form.email = ''
                    this.addMode = true
                }
            }
        }
    </script>
</body>
</html><?php /**PATH D:\blog\resources\views/welcome.blade.php ENDPATH**/ ?>