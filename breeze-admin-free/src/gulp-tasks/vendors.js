'use strict'
var gulp = require('gulp');
var concat = require('gulp-concat');
var merge = require('merge-stream');
const del = require('del');


gulp.task('clean:vendors', function () {
    return del([
      './assets/vendors/**/*'
    ]);
});

/*Building vendor scripts needed for basic template rendering*/
gulp.task('buildBaseVendorScripts', function() {
    return gulp.src([
        '../node_modules/jquery/dist/jquery.min.js', 
        // '../node_modules/popper.js/dist/umd/popper.min.js',
        '../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js', 
        '../node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js'
    ])
      .pipe(concat('vendor.bundle.base.js'))
      .pipe(gulp.dest('./assets/vendors/js'));
});

/*Building vendor styles needed for basic template rendering*/
gulp.task('buildBaseVendorStyles', function() {
    return gulp.src(['../node_modules/perfect-scrollbar/css/perfect-scrollbar.css'])
      .pipe(concat('vendor.bundle.base.css'))
      .pipe(gulp.dest('./assets/vendors/css'));
});

/*Scripts for addons*/
gulp.task('buildOptionalVendorScripts', function() {
    var aScript1 = gulp.src(['../node_modules/chart.js/dist/Chart.min.js'])
        .pipe(gulp.dest('./assets/vendors/chart.js'));
    var aScript10 = gulp.src(['../node_modules/flot/jquery.flot.js'])
        .pipe(gulp.dest('./assets/vendors/flot'));
    var aScript11 = gulp.src(['../node_modules/flot/jquery.flot.resize.js'])
        .pipe(gulp.dest('./assets/vendors/flot'));
    var aScript12 = gulp.src(['../node_modules/flot/jquery.flot.categories.js'])
        .pipe(gulp.dest('./assets/vendors/flot'));
    var aScript13 = gulp.src(['../node_modules/flot/jquery.flot.fillbetween.js'])
        .pipe(gulp.dest('./assets/vendors/flot'));
    var aScript14 = gulp.src(['../node_modules/flot/jquery.flot.stack.js'])
        .pipe(gulp.dest('./assets/vendors/flot'));
    var aScript15 = gulp.src(['../node_modules/flot/jquery.flot.pie.js'])
        .pipe(gulp.dest('./assets/vendors/flot'));
    var aScript23 = gulp.src(['../node_modules/pwstabs/assets/jquery.pwstabs.min.js'])
        .pipe(gulp.dest('./assets/vendors/pwstabs'));
    var aScript29 = gulp.src(['../node_modules/jquery-file-upload/js/jquery.uploadfile.min.js'])
        .pipe(gulp.dest('./assets/vendors/jquery-file-upload'));    
    var aScript33 = gulp.src(['../node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js'])
        .pipe(gulp.dest('./assets/vendors/bootstrap-datepicker'));
    var aScript36 = gulp.src(['../node_modules/tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.js'])
        .pipe(gulp.dest('./assets/vendors/tempusdominus-bootstrap-4'));    
    var aScript38 = gulp.src(['../node_modules/typeahead.js/dist/typeahead.bundle.min.js'])
        .pipe(gulp.dest('./assets/vendors/typeahead.js'));
    var aScript39 = gulp.src(['../node_modules/select2/dist/js/select2.min.js'])
        .pipe(gulp.dest('./assets/vendors/select2'));
    var aScript40 = gulp.src(['../node_modules/codemirror/lib/codemirror.js'])
        .pipe(gulp.dest('./assets/vendors/codemirror'));
    var aScript41 = gulp.src(['../node_modules/codemirror/mode/javascript/javascript.js'])
        .pipe(gulp.dest('./assets/vendors/codemirror'));
    var aScript42 = gulp.src(['../node_modules/codemirror/mode/shell/shell.js'])
        .pipe(gulp.dest('./assets/vendors/codemirror'));
    var aScript55 = gulp.src(['../node_modules/datatables.net/js/jquery.dataTables.js'])
        .pipe(gulp.dest('./assets/vendors/datatables.net'));
    var aScript56 = gulp.src(['../node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js'])
        .pipe(gulp.dest('./assets/vendors/datatables.net-bs4'));
    var aScript57 = gulp.src(['../node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js'])
        .pipe(gulp.dest('./assets/vendors/datatables.net-bs4'));
    var aScript59 = gulp.src(['../node_modules/owl-carousel-2/owl.carousel.min.js'])
        .pipe(gulp.dest('./assets/vendors/owl-carousel-2'));

    return merge(aScript1, aScript10,aScript11,aScript12,aScript13,aScript14,aScript15,aScript23,aScript29,aScript33,aScript36,aScript38,aScript39,aScript40,aScript41,aScript42,aScript55,aScript56,aScript57,aScript59);
});


/*Styles for addons*/
gulp.task('buildOptionalVendorStyles', function() {
    var aStyle1 = gulp.src(['../node_modules/@mdi/font/css/materialdesignicons.min.css'])
        .pipe(gulp.dest('./assets/vendors/mdi/css'));
    var aStyle2 = gulp.src(['../node_modules/@mdi/font/fonts/*'])
        .pipe(gulp.dest('./assets/vendors/mdi/fonts'));
    var aStyle3 = gulp.src(['../node_modules/font-awesome/css/font-awesome.min.css'])
        .pipe(gulp.dest('./assets/vendors/font-awesome/css'));
    var aStyle4 = gulp.src(['../node_modules/font-awesome/fonts/*'])
        .pipe(gulp.dest('./assets/vendors/font-awesome/fonts'));
    var aStyle5 = gulp.src(['../node_modules/flag-icon-css/css/flag-icon.min.css'])
        .pipe(gulp.dest('./assets/vendors/flag-icon-css/css'));
    var aStyle6 = gulp.src(['../node_modules/flag-icon-css/flags/**/*'])
        .pipe(gulp.dest('./assets/vendors/flag-icon-css/flags'));
    var aStyle7 = gulp.src(['../node_modules/simple-line-icons/css/simple-line-icons.css'])
        .pipe(gulp.dest('./assets/vendors/simple-line-icons/css'));
    var aStyle8 = gulp.src(['../node_modules/simple-line-icons/fonts/*'])
        .pipe(gulp.dest('./assets/vendors/simple-line-icons/fonts'));
    var aStyle9 = gulp.src(['../node_modules/ti-icons/css/themify-icons.css'])
        .pipe(gulp.dest('./assets/vendors/ti-icons/css'));
    var aStyle10 = gulp.src(['../node_modules/ti-icons/fonts/*'])
        .pipe(gulp.dest('./assets/vendors/ti-icons/fonts'));                 
    var aStyle28 = gulp.src(['../node_modules/jquery-file-upload/css/uploadfile.css'])
        .pipe(gulp.dest('./assets/vendors/jquery-file-upload'));
    var aStyle29 = gulp.src(['../node_modules/tempusdominus-bootstrap-4/build/css/tempusdominus-bootstrap-4.min.css'])
        .pipe(gulp.dest('./assets/vendors/tempusdominus-bootstrap-4'));    
    var aStyle32 = gulp.src(['../node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css'])
        .pipe(gulp.dest('./assets/vendors/bootstrap-datepicker'));    
    var aStyle34 = gulp.src(['../node_modules/select2/dist/css/select2.min.css'])
        .pipe(gulp.dest('./assets/vendors/select2')); 
    var aStyle35 = gulp.src(['../node_modules/select2-bootstrap-theme/dist/select2-bootstrap.min.css'])
        .pipe(gulp.dest('./assets/vendors/select2-bootstrap-theme'));
    var aStyle36 = gulp.src(['../node_modules/codemirror/lib/codemirror.css'])
        .pipe(gulp.dest('./assets/vendors/codemirror'));
    var aStyle37 = gulp.src(['../node_modules/codemirror/theme/ambiance.css'])
        .pipe(gulp.dest('./assets/vendors/codemirror'));    
    var aStyle42 = gulp.src(['../node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css'])
        .pipe(gulp.dest('./assets/vendors/datatables.net-bs4'));    
    var aStyle45 = gulp.src(['../node_modules/owl-carousel-2/assets/owl.carousel.min.css'])
        .pipe(gulp.dest('./assets/vendors/owl-carousel-2'));
    var aStyle46 = gulp.src(['../node_modules/owl-carousel-2/assets/owl.theme.default.min.css'])
        .pipe(gulp.dest('./assets/vendors/owl-carousel-2'));
    var aStyle47 = gulp.src(['../node_modules/owl-carousel-2/assets/owl.video.play.png'])
        .pipe(gulp.dest('./assets/vendors/owl-carousel-2'));
    var aStyle54 = gulp.src(['../node_modules/pwstabs/assets/jquery.pwstabs.min.css'])
        .pipe(gulp.dest('./assets/vendors/pwstabs'));    
    var aStyle56 = gulp.src(['../node_modules/typicons.font/src/font/*'])
        .pipe(gulp.dest('./assets/vendors/typicons'));    
    var aStyle58 = gulp.src(['../node_modules/puse-icons-feather/**/*'])
        .pipe(gulp.dest('./assets/vendors/puse-icons-feather'));
    return merge(aStyle1, aStyle2, aStyle3, aStyle4, aStyle5, aStyle6, aStyle7, aStyle8, aStyle9, aStyle10, aStyle28, aStyle29, aStyle32, aStyle34, aStyle35, aStyle36, aStyle37, aStyle42, aStyle45, aStyle46, aStyle47, aStyle54, aStyle56, aStyle58);
});

//Copy essential map files
gulp.task('copyMapFiles', function() {
    var map1 = gulp.src('../node_modules/bootstrap/dist/js/bootstrap.min.js.map')
        .pipe(gulp.dest('./assets/vendors/js'));
    var map2 = gulp.src('../node_modules/@mdi/font/css/materialdesignicons.min.css.map')
        .pipe(gulp.dest('./assets/vendors/mdi/css'));    
    return merge(map1, map2);
});

/*sequence for building vendor scripts and styles*/
gulp.task('bundleVendors', gulp.series('clean:vendors', 'buildBaseVendorStyles','buildBaseVendorScripts', 'buildOptionalVendorStyles', 'buildOptionalVendorScripts', 'copyMapFiles'));