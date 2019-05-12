'use strict'

const gulp = require('gulp')
const sass = require('gulp-sass')
const tildeImporter = require('node-sass-tilde-importer')
const livereload = require('gulp-livereload')

const source = {
  scss: './src/scss',
  public: './public',
}

const dest = {
  root: './public',
  css: './public/css',
}

// CSS injection on SCSS compile
gulp.task('sass-dev', () => (
  gulp.src(`${source.scss}/main.scss`)
    .pipe(sass({ importer: tildeImporter }))
    .on('error', console.log)
    .pipe(gulp.dest(dest.css))
    .pipe(livereload())
))

// Full page reload on static file changes
gulp.task('reload', (done) => {
  gulp.src(source.public)
    .pipe(livereload())
  done()
})

// Local dev watcher
gulp.task('watch', () => {
  livereload.listen()
  gulp.watch('**/*.scss', { cwd: source.scss }, gulp.series('sass-dev'))
  gulp.watch(['**/*', '!css/*'], { cwd: source.public }, gulp.series('reload'))
})

// Build SCSS for production
gulp.task('sass', () => (
  gulp.src(source.scss)
    .pipe(sass({importer: tildeImporter})) 
    .pipe(gulp.dest(dest.css))
))

gulp.task('default', gulp.series('sass-dev', 'watch'))
gulp.task('prod', gulp.series('sass'))
