<!-- footer -->
<footer class="ftco-footer ftco-section">
      <div class="container">
         
         <div class="row mb-5">     
            <div class="col-md">
               <div class="ftco-footer-widget mb-4">
                  <h2 class="ftco-heading-2">Tentang SIPetani</h2>
                  <p>SIPetani merupakan Sistem Informasi yang meneyediakan layanan penjualan tiket tempat wisata edukasi <span class="text-uppercase text-primary">botani sukorambi</span> secara online berbasis web.</p>
                  <div class="icon-custom">
                     <ul class="list-unstyled float-md-left float-lft mt-5">
                        <li class="ftco-animate">
                           <a href="https://facebook.com"><i class="fab fa-facebook-f icon"></i></a>
                        </li>
                        <li class="ftco-animate">
                           <a href="https://twitter.com"><i class="fab fa-twitter icon"></i></a>
                        </li>
                        <li class="ftco-animate">
                           <a href="https://instagram.com"><i class="fab fa-instagram icon"></i></a></li>
                        <li class="ftco-animate">
                           <a href="https://plus.google.com"><i class="fab fa-google-plus-g icon"></i></a>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
            
            <div class="col-md">
               <div class="ftco-footer-widget mb-4 ml-md-4">
                  <h2 class="ftco-heading-2">Fitur</h2>
                  <ul class="list-unstyled">
                     <li><a href="<?= base_url('landing_home'); ?>"><span class="icon-long-arrow-right mr-2"></span>Home</a></li>
                     <li><a href="<?= base_url('landing_home/#layanan'); ?>"><span class="icon-long-arrow-right mr-2"></span>Layanan</a></li>
                     <li><a href="<?= base_url('landing_home/#sarana'); ?>"><span class="icon-long-arrow-right mr-2"></span>Sarana</a></li>
                     <li><a href="<?= base_url('landing_home/#tentang'); ?>"><span class="icon-long-arrow-right mr-2"></span>Tentang</a></li>
                     <li><a href="<?= base_url('landing_home/#tiket'); ?>"><span class="icon-long-arrow-right mr-2"></span>Tiket</a></li>
                  </ul>
               </div>
            </div>
             
            <div class="col-md">
               <div class="ftco-footer-widget mb-4">
                  <h2 class="ftco-heading-2">Layanan</h2>
                  <ul class="list-unstyled">
                     <li><a href="<?= base_url('landing_home/#layanan'); ?>"><span class="icon-long-arrow-right mr-2"></span>Pemesanan Tiket</a></li>
                     <li><a href="<?= base_url('landing_home/#layanan'); ?>"><span class="icon-long-arrow-right mr-2"></span>Edukasi Anak</a></li>
                     <li><a href="<?= base_url('landing_home/#layanan'); ?>"><span class="icon-long-arrow-right mr-2"></span>Hiburan</a></li>
                     <li><a href="<?= base_url('landing_home/#layanan'); ?>"><span class="icon-long-arrow-right mr-2"></span>Lokasi</a></li>
                  </ul>
               </div>
            </div>

            <div class="col-md">
               <div class="ftco-footer-widget mb-4">
                  <h2 class="ftco-heading-2">Bingung Lokasi ?</h2>
                  <div class="block-23 mb-3">
                     <iframe class="ftco-animate" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1974.6995165789642!2d113.66198411594745!3d-8.162491030957538!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x1f02ba93aedf2352!2sTaman%20Botani%20Sukorambi%20Jember!5e0!3m2!1sid!2sid!4v1582569619613!5m2!1sid!2sid" width="200" height="220" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                  </div>
               </div>
            </div> 
         </div>   
            
         <div class="row">
            <div class="col-md-12 text-center">
               <p>Copyright &copy;<?= date("Y"); ?> <span class="text-primary text-uppercase">sip</span>etani.com | This template made with <i class="icon-heart text-primary"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a></p>
            </div>
         </div>
      
      </div>
   </footer>
   <!-- akhir footer -->
       
  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Apa Anda yakin ingin keluar?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
         Klik tombol Logout untuk mengakhiri sesi akun anda.
        <img height="400" class="my-2" src="<?= base_url(); ?>assets/img/svg/logout.svg">
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary-bs" type="button" data-dismiss="modal">Batal</button>
          <a class="btn btn-primary-bs" href="<?= base_url('logout'); ?>">Logout</a>
        </div>
      </div>
    </div>
  </div>

   <!-- loader -->
   <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

  
   <script src="<?= base_url('assets/js/jquery-3.4.1.min.js'); ?>"></script>
   <script src="<?= base_url('assets/js/jquery.easing.min.js'); ?>"></script>
   <script src="<?= base_url('assets/js/jquery-migrate-3.0.1.min.js'); ?>"></script>
   <script src="<?= base_url('assets/js/bootstrap.min.js'); ?>"></script>
   <script src="<?= base_url('assets/js/popper.min.js'); ?>"></script>
   <script src="<?= base_url('assets/js/all.js'); ?>"></script>
   <script src="<?= base_url('assets/js/jquery.waypoints.min.js'); ?>"></script>
   <script src="<?= base_url('assets/js/jquery.stellar.min.js'); ?>"></script>
   <script src="<?= base_url('assets/js/owl.carousel.min.js'); ?>"></script>
   <script src="<?= base_url('assets/js/jquery.magnific-popup.min.js'); ?>"></script>
   <script src="<?= base_url('assets/js/aos.js'); ?>"></script>
   <script src="<?= base_url('assets/js/jquery.animateNumber.min.js'); ?>"></script>
   <script src="<?= base_url('assets/js/scrollax.min.js'); ?>"></script>
   <script src="<?= base_url('assets/js/main.js'); ?>"></script>
   <script src="<?= base_url('assets/js/script.js'); ?>"></script>
   </body>
</html>
