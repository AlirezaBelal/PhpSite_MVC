<!-- Link Css -->
<link rel="stylesheet" href="./Css/UplodeFile.css">

<section>
    <div class="container p-5">
        <div class="row mb-5 text-center text-white">
            <div class="col-lg-10 mx-auto">
                <!-- TODO:php Username -->
                <h1 class="display-4">File upload By <?php echo $name ?> </h1>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-5 mx-auto">
                <div class="p-5 bg-white shadow rounded-lg"><img
                            src="https://res.cloudinary.com/mhmd/image/upload/v1557366994/img_epm3iz.png" alt=""
                            width="200" class="d-block mx-auto mb-4 rounded-pill">

                    <form action="/upload" method="POST" enctype="multipart/form-data">
                        <div class="mb-5">
                            <div class="input-group-prepend">
                                <label class="input-group-text">File Name</label>
                            </div>
                            <input type="text" name="name" aria-label="FileName" class="form-control">
                        </div>


                        <div class="custom-file overflow-hidden rounded-pill mb-5">
                            <input id="customFile" type="file" name="file" class="custom-file-input rounded-pill">
                            <label for="customFile" class="custom-file-label rounded-pill">Choose file</label>
                        </div>

                        <div class="mb-5" align="center">
                            <button type="submit" class="btn btn-light">Uplode</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>


