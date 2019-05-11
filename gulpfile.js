'use strict'

const gulp = require('gulp')
const sass = require('gulp-sass')
const tildeImporter = require('node-sass-tilde-importer')
const livereload = require('gulp-livereload')

const sourcePath = './src'
const scssSource = `${sourcePath}/scss/main.scss`
const publicPath = `./public`

// CSS injection on SCSS compile
gulp.task('sass-dev', () => (
  gulp.src(scssSource)
    .pipe(sass({ importer: tildeImporter }))
    .on('error', console.log)
    .pipe(gulp.dest(publicPath))
    .pipe(livereload())
))

// Full page reload on HTML changes
gulp.task('reload', (done) => {
  gulp.src(sourcePath)
    .pipe(livereload())
  done()
})

// Local dev watcher
gulp.task('watch', () => {
  livereload.listen()
  gulp.watch('scss/**/*.scss', { cwd: `${sourcePath}/` }, gulp.series('sass-dev'))
  gulp.watch('**/*', { cwd: `${sourcePath}/` }, gulp.series('reload'))
})

// Build SCSS for production
gulp.task('sass-prod', () => (
  gulp.src(scssSource)
    .pipe(sass({importer: tildeImporter})) 
    .pipe(gulp.dest(publicPath))
))

gulp.task('default', gulp.series('sass-dev', 'watch'))
gulp.task('prod', gulp.series('sass-prod'))
