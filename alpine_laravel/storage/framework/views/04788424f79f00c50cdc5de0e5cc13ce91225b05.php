<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous"/>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <title>CRUD Application</title>
</head>

<body>
    <div class="container-fluid mt-5" x-data="companyCrud()" x-init="getAllCompanies()">
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-header text-light bg-info" >
                        Company Table
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead class="thead">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template x-for="(company,index) in companies" :key="index">
                                    <tr>
                                        <td x-text="index+1"></td>
                                        <td x-text="company.name"></td>
                                        <td>
                                            <img :src="`http://localhost:8000/storage/img/${company.image}`"
                                                width="100px" height="100px" />
                                        </td>
                                        <td>
                                            <button @click.prevent="editCompany(company,index)"
                                                class="btn btn-success">Edit</button>
                                            <button @click.prevent="removeCompany(index)"
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
                        <span x-show="addMode">Create Company</span>
                        <span x-show="!addMode">Edit Company</span>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="createCompany" x-show="addMode" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input x-model="company.name" type="text" class="form-control"
                                    placeholder="Enter Name">
                            </div>
                            <small></small>
                            <div class="form-group">
                                <label>Image:</label>
                                <img id="frame">
                                <input x-model="company.image" type="file" id="file" class="form-control">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>

                        </form>
                        <form @submit.prevent="updateData()" enctype="multipart/form-data" x-show="!addMode">
                            <div class="form-group">
                                <label>Name</label>
                                <input x-model="company.name" type="text" class="form-control"
                                    placeholder="Enter Name" x-text="company.name">
                            </div>
                                <div class="form-group">
                                    <img :src= "company.image" alt="company image"  width="100px" height="100px" id="photo" 
                                    x-text="company.image"/><br><br>
                                    <label for="image">Image</label>
                                     <input type="file" id="image" class="form-control"> 
                                </div>
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <button type="button" class="btn btn-danger" @click.prevent="cancel">Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function companyCrud() {
            return {
                addMode: true,
                error: "",
                id: '',
                company: {
                    name: null,
                    image: null
                },
                companies: [],
                getAllCompanies() {
                    axios.get('http://127.0.0.1:8000/api/company').then(response => {
                        this.companies = response.data;
                    });
                    console.log(this.companies);
                },

                createCompany() {
                    var formData = new FormData();
                    var file = document.getElementById('file');
                    formData.append("name", this.company.name);
                    formData.append("image", file.files[0]);
                    console.log(file.files[0])
                    axios.post('http://127.0.0.1:8000/api/company', formData)
                        .then((response) => {
                            console.log(response);
                        });
                    location.reload();
                },

                editCompany(company, index) {
                    this.addMode = false
                    this.company.name = company.name,
                    console.log(company.name);
                    this.image = `./storage/${company.image}`,
                    console.log(company);
                    this.id = index
                },

                updateData(id) {
                    var formData = new FormData();
                    var imageFile = document.getElementById('image');
                    formData.append("name", this.name);
                    formData.append("image", imageFile.files[0]);
                    console.log(imageFile.files[0])
                    axios.post(`http://127.0.0.1:8000/api/company/edit/${this.company.id}`, formData)
                        .then((response) => {
                            company = this.company,
                            console.log(company);
                        });
                },

                removeCompany(index) {
                    let res = fetch(`http://127.0.0.1:8000/api/company/${this.company.id}`, {
                        method: 'DELETE',
                    });
                    this.companies.splice(index, 1);
                    console.log(res);
                },
                // changeImage(event) {
                //     let frame = document.getElementById("photo");
                //     frame.setAttribute("src", URL.createObjectURL(event.target.files[0]));
                // }
                cancel() {
                    this.resetForm()
                },
                resetForm() {
                    this.company.name = ''
                    this.addMode = true
                }

            }
        }
    </script>
</body>

</html>
<?php /**PATH D:\training\laravel_alpine\alpine_laravel\resources\views/company.blade.php ENDPATH**/ ?>