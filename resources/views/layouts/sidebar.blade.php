<div id="sidebar" style="background-color: rgb(241, 59, 57);">
    <div class="text-white py-5 px-3" style="height: 100vh">
        <div class="d-flex justify-content-between">
            <h5 class="fw-bold"><img src="{{ asset('image/Handbag.png') }}" alt="" class=""> SIMS Web App</h5>
            <a href="#" class="text-white fs-4" onclick="toggleSidebar()"><i class="bi bi-list"></i></a>
        </div>

        <div class="text-white mt-5">
            <div class="mb-4">
                <img src="{{ asset('image/Package.png') }}" alt="">
                <a href="" style="text-decoration: none;" class="text-white ms-2">Produk</a>
            </div>
            <div class="mb-4">
                <img src="{{ asset('image/User.png') }}" alt="">
                <a href="" style="text-decoration: none;" class="text-white ms-2">Profil</a>
            </div>
            <div>
                <img src="{{ asset('image/SignOut.png') }}" alt="">
                <a href="" style="text-decoration: none;" class="text-white ms-2">Logout</a>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleSidebar() {
        var sidebar = document.getElementById("sidebar");
        if (sidebar.style.width === "100px") {
            sidebar.style.width = "250px"; // Ubah 250px sesuai lebar sidebar Anda
        } else {
            sidebar.style.width = "100px";
        }
    }

</script>