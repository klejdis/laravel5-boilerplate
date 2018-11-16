const { mix } = require('laravel-mix');
require('laravel-mix-merge-manifest');

mix.setPublicPath('../../public').mergeManifest();

mix.styles([
    'Resources/assets/bower_components/bootstrap/dist/css/bootstrap.min.css',
    'Resources/assets/bower_components/font-awesome/css/font-awesome.min.css',
    'Resources/assets/bower_components/datatables/media/css/jquery.dataTables.min.css',
    'Resources/assets/bower_components/select2/select2.css',
    'Resources/assets/bower_components/select2/select2-bootstrap.css',
    'Resources/assets/bower_components/select2-bootstrap-css/select2-bootstrap.min.css',
    'Resources/assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css',
    'Resources/assets/bower_components/x-editable/dist/bootstrap-editable/css/bootstrap-editable.css',
    'Resources/assets/bower_components/dropzone/dist/min/dropzone.min.css',
    'Resources/assets/bower_components/magnific-popup/dist/magnific-popup.css',
    'Resources/assets/bower_components/awesomplete/awesomplete.css',
    'Resources/assets/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css',
    'Resources/assets/css/font.css',
    'Resources/assets/css/style.css',
    'Resources/assets/css/invoice.css',
    'Resources/assets/css/custom-style.css',
], '../../public/admin/css/vendor.css');


mix.copyDirectory('Resources/assets/bower_components/font-awesome/fonts', '../../public/admin/fonts');

mix.copyDirectory('Resources/assets/css/fonts', '../../public/admin/css/fonts');

mix.copyDirectory('Resources/assets/images', '../../public/admin/images');

mix.copyDirectory('Resources/assets/bower_components/select2/select2.png', '../../public/admin/css');

mix.copyDirectory('Resources/assets/bower_components/select2/select2-spinner.gif', '../../public/admin/css');

mix.scripts([
    'Resources/assets/bower_components/jquery/dist/jquery.min.js',
    'Resources/assets/bower_components/bootstrap/dist/js/bootstrap.min.js',
    'Resources/assets/bower_components/moment/min/moment.min.js',
    'Resources/assets/bower_components/jquery-validation/dist/jquery.validate.min.js',
    'Resources/assets/bower_components/jquery-form/dist/jquery.form.min.js',
    'Resources/assets/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js',
    'Resources/assets/bower_components/datatables/media/js/jquery.dataTables.min.js',
    'Resources/assets/bower_components/select2/select2.min.js',
    'Resources/assets/bower_components/datatables-tabletools/js/dataTables.tableTools.js',
    'Resources/assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
    'Resources/assets/bower_components/bootstrap-timepicker/js/bootstrap-timepicker.js',
    'Resources/assets/bower_components/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js',
    'Resources/assets/bower_components/magnific-popup/dist/jquery.magnific-popup.min.js',
],
    '../../public/admin/js/vendor.js');


mix.js(__dirname + '/Resources/assets/js/app.js', 'admin/js/admin.js')
    .sass( __dirname + '/Resources/assets/sass/app.scss', 'admin/css/admin.css');



// if (mix.inProduction()) {
//     mix.version();
// }