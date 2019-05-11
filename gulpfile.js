const gulp = require('gulp')
const sass = require('gulp-sass')
const tildeImporter = require('node-sass-tilde-importer')
const livereload = require('gulp-livereload')

function swallowError(error) {
  console.log(error.toString())
}

const sourcePath = './src'
const scssSource = `${sourcePath}/scss/main.scss`
const publicPath = `./public`

// CSS injection on SCSS compile
gulp.task('sass-dev', function () {
  return gulp.src(scssSource)
    .pipe(sass({
      importer: tildeImporter
    }))
    .on('error', swallowError)
    .pipe(gulp.dest(publicPath))
    .pipe(livereload())
})

// Full page reload on HTML changes
gulp.task('reload', function (done) {
  gulp.src(sourcePath)
    .pipe(livereload())
  done()
})

// Local dev watcher
gulp.task('watch', function () {
  livereload.listen()
  gulp.watch('scss/**/*.scss', {cwd: `${sourcePath}/`}, gulp.series('sass-dev'))
  gulp.watch('**/*', {cwd: `${sourcePath}/`}, gulp.series('reload'))
})

gulp.task('default', gulp.series('sass-dev', 'watch'))
