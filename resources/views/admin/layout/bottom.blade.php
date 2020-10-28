<footer class="main-footer">
    <div class="footer-left">
      <a href="templateshub.net">ThangDepTrai</a>
    </div>
    <div class="footer-right">
    </div>
  </footer>
</div>
</div>
<!-- General JS Scripts -->
<script> CKEDITOR.replace('ckeditor');</script>
<script src="{{ asset('assets/js/app.min.js') }}"></script>
<!-- JS Libraies -->
<script src="{{ asset('assets/bundles/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/bundles/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/bundles/jquery.repeatable-master/jquery.repeatable.js') }}"></script>
<script src="{{ asset('assets/bundles/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('assets/bundles/izitoast/js/iziToast.min.js') }}"></script>
<script src="{{ asset('assets/bundles/bootstrap-daterangepicker/daterangepicker.js') }}"></script> 
<script src="{{ asset('assets/bundles/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('assets/bundles/autoNumeric/autoNumeric.js') }}"></script>
<script src="{{ asset('assets/bundles/chartjs/chart.min.js') }}"></script> 
<!-- Page Specific JS File -->
<script src="{{ asset('assets/js/page/index.js') }}"></script>
<script src="{{ asset('assets/js/page/datatables.js') }}"></script>
<script src="{{ asset('assets/js/page/toastr.js') }}"></script>
<script src="{{ asset('assets/js/page/forms-advanced-forms.js') }}"></script> 
<!-- Template JS File -->
<script src="{{ asset('assets/js/scripts.js') }}"></script>
<!-- Custom JS File -->
<script src="{{ asset('assets/js/custom.js') }}"></script>

@if (\Session::has('welcomeCode'))
        {!! \Session::get('welcomeCode') !!}
@endif
</body>
<!-- index.html  21 Nov 2019 03:47:04 GMT -->
</html>