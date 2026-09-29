const menu = $('.Header');
const menuBtn = $('.HeaderMenuBtn');
const search = $('.search-filters');
const bloc = $('.search-filters-container');
const form1 = $('.form1');
const form2 = $('.form2');
// подключение подсказок
$(function(){
    // инициализации подсказок для всех элементов на странице, имеющих атрибут data-toggle="tooltip"
    $('[data-toggle="tooltip"]').tooltip();
});
// получение и возвращение значений
function Save(theme)
{
    var Request = new XMLHttpRequest();
    Request.open("GET", "themes.php?theme=" + theme, true); //У вас путь может отличаться
    Request.send();
}
// функции клика на кнопки
$(".HeaderMenuBtn").click(function() {
	if (menu.hasClass("is-activeLoginWindow"))
    menu.removeClass("is-activeLoginWindow");
    menu.toggleClass("is-activeNav");
});
$(".HeaderLoginBtn").click(function() {
	if (menu.hasClass("is-activeNav"))
        menu.removeClass("is-activeNav");
    menu.toggleClass("is-activeLoginWindow");
});

$('.filters').click(function() {
    search.toggleClass("hidden");
    bloc.toggleClass("chet-bloka");
});

$('.diargod').click(function() {
    $('.canypukillme').addClass("not-activ");
    $('.diargod').removeClass("not-activ");
    form1.removeClass("hidden");
    form2.addClass("hidden");
});

$('.canypukillme').click(function() {
    $('.diargod').addClass("not-activ");
    $('.canypukillme').removeClass("not-activ");
    form2.removeClass("hidden");
    form1.addClass("hidden");
});
// функция для сворачивания в случае клика вне поля для меню
$(document).mouseup(function (e) {
    if ((menu.has(e.target).length === 0)) {
        // if ($(window).width() < 768) { 
            menu.removeClass('is-activeNav');
            menu.removeClass('is-activeLoginWindow');
        // } 
    }
});
$(document).mouseup(function (e) {
    if ((search.has(e.target).length === 0) && ($('.filters').has(e.target).length === 0)) {
        // if ($(window).width() < 768) { 
            bloc.removeClass("chet-bloka");
            search.addClass('hidden');
        // } 
    }
});

var btn = $(".HeaderTemaBtn");
var link = document.getElementById("theme-link");

// функия для смены темы на сайте
$(".HeaderTemaBtn").click(function() {
    let lightTheme = "css/light.css";
    let darkTheme = "css/dark.css";

    var currTheme = link.getAttribute("href");
    var theme = "";

    if(currTheme == lightTheme)
    {
     currTheme = darkTheme;
     theme = "dark";
    }
    else
    {    
     currTheme = lightTheme;
     theme = "light";
    }

    link.setAttribute("href", currTheme);

    Save(theme);
});
// делаем загрузку страницы
var loader1 = $(".loader-wrapper2");
var loader2 = $(".loader-wrapper1");
var loader = $(".loader");
var wHeight = $(window).height();
var wWidth = $(window).width();
var o = 768;
var ooo = 0;

loader1.animate({
 top: 0,
 width: '100%'
}, 0)
loader1.animate({
 right: '0',
 height: '50vh'
},0)

loader2.animate({
 bottom: 0,
 width: '100%'
}, 0)
loader2.animate({
 right: '0',
 height: '50vh'
},0)

 loader.css({
 top: wHeight / 2 - 2.5,
 left: wWidth / 2 - 200
 })

 do {
 loader.animate({width: ooo}, 10)
 ooo += 3;
 } 
 while (ooo <= 400)

 if (ooo == 402) {
 do {
     loader1.animate({height: o}, 10)
     loader2.animate({height: o}, 10)
     o -= 3;
 } 
 while (o >= 0)
}
 setTimeout(function() {
 $(".loader-wrapper").fadeOut('fast');
 (loader).fadeOut('fast');
 }, 2000);

//задаем максимальную длинну для поля краткого описания
$(document).ready(function(){
    var maxCount = 500;

    $("#counter").html(maxCount);

    $("#review-text").keyup(function() {
    var revText = this.value.length;

        if (this.value.length > maxCount)
            {
            this.value = this.value.substr(0, maxCount);
            }
        var cnt = (maxCount - revText);
        if(cnt <= 0){$("#counter").html('0');}
        else {$("#counter").html(cnt);}

    });
});


$( document ).ready(function() {
    // реализация скрипта переключения страниц панели администратора
    $('.button_admin').click(function(){
        $.ajax({
            url: 'http://localhost/%D0%B4%D0%B8%D0%BF%D0%BB%D0%BE%D0%BC/itog/adpanel.php',
            method: 'post',
            dataType: 'html',
            data: {'valuepanel': $(this).val()},
            success: function(data){
                location.reload();
            }
        });
    });

});
// скрипт для карусели фото на странице новости
// Fit inner div to gallery
$('<div />', { 'class': 'inner'  }).appendTo('.gallery');

// Create main image block and apply first img to it
var imageSrc1 = $('.gallery').children('img').eq(0).attr('src');
$('<div />', { 'class': 'main'  }).appendTo('.gallery .inner').css('background-image', 'url(' + imageSrc1 + ')');

// Create image number label
var noOfImages = $('.gallery').children('img').length;
$('<span />').appendTo('.gallery .inner .main').html('Image 1 of ' + noOfImages);

// Create thumb roll
$('<div />', { 'class': 'thumb-roll'  }).appendTo('.gallery .inner');

// Create thumbail block for each image inside thumb-roll
$('.gallery').children('img').each( function() {
  var imageSrc = $(this).attr('src');
  $('<div />', { 'class': 'thumb'  }).appendTo('.gallery .inner .thumb-roll').css('background-image', 'url(' + imageSrc + ')');
});

// Make first thumbnail selected by default
$('.thumb').eq(0).addClass('current');

// Select thumbnail function
$('.thumb').click(function() {
  
  // Make clicked thumbnail selected
  $('.thumb').removeClass('current');
  $(this).addClass('current');
  
  // Apply chosen image to main
  var imageSrc = $(this).css('background-image');
  $('.main').css('background-image', imageSrc);
  $('.main').addClass('main-selected');
  setTimeout(function() {
    $('.main').removeClass('main-selected');
  }, 500);
  
  // Change text to show current image number
  var imageIndex = $(this).index();
  $('.gallery .inner .main span').html('Image ' + (imageIndex + 1) + ' of ' + noOfImages);
});

// Arrow key control function
$(document).keyup(function(e) {

  // If right arrow
  if (e.keyCode === 39) {

  // Mark current thumbnail
  var currentThumb = $('.thumb.current');
  var currentThumbIndex = currentThumb.index();
  if ( (currentThumbIndex+1) >= noOfImages) { // if on last image
    nextThumbIndex = 0; // ...loop back to first image
  } else {
    nextThumbIndex = currentThumbIndex+1;
  }
  var nextThumb = $('.thumb').eq(nextThumbIndex);
  currentThumb.removeClass('current');
  nextThumb.addClass('current');
  
  // Switch main image
  var imageSrc = nextThumb.css('background-image');
  $('.main').css('background-image', imageSrc);
  $('.main').addClass('main-selected');
  setTimeout(function() {
    $('.main').removeClass('main-selected');
  }, 500);
  
  // Change text to show current image number
  $('.gallery .inner .main span').html('Image ' + (nextThumbIndex+1) + ' of ' + noOfImages);
  }
  // If left arrow
  if (e.keyCode === 37) { 

  // Mark current thumbnail
  var currentThumb = $('.thumb.current');
  var currentThumbIndex = currentThumb.index();
  if ( currentThumbIndex == 0) { // if on first image
    prevThumbIndex = noOfImages-1; // ...loop back to last image
  } else {
    prevThumbIndex = currentThumbIndex-1;
  }
  var prevThumb = $('.thumb').eq(prevThumbIndex);
  currentThumb.removeClass('current');
  prevThumb.addClass('current');
  
  // Switch main image
  var imageSrc = prevThumb.css('background-image');
  $('.main').css('background-image', imageSrc);
  $('.main').addClass('main-selected');
  setTimeout(function() {
    $('.main').removeClass('main-selected');
  }, 500);
  // Change text to show current image number
  $('.gallery .inner .main span').html('Image ' + (prevThumbIndex+1) + ' of ' + noOfImages);
  }  });


    $("pre[name='pre']").each(function () {
        var html = $(this).html()
        var blankLen = (html.split('\n')[0].match(/^\s+/)[0]).length
        $(this).html($.trim(html.replace(eval("/^ {" + blankLen + "}/gm"), "")))
    })
