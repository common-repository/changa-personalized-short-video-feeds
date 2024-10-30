var $ = window.$;
var jQuery = $;
var appId = $("#changa-slider").attr("appid");
var WEBSITE_URL = "https://www.changa.in";
//set vh size
var page = 1;
var vh = window.innerHeight * 0.01;
var videos = [];
var limit = 10;
var noData = false;
// Then we set the value in the --vh custom property to the root of the document
document.documentElement.style.setProperty("--vh", `${vh}px`);
//add modal in body
if (document.querySelector(".md-modal")) {
  // don't add modal it's already in dom
} else {
  var modal = document.createElement("div");
  //Set its unique ID.
  modal.className = "md-modal";
  //Add your content to the DIV
  modal.innerHTML = `
     <div class="md-content">
 <div class="md-close">
        <svg class="md-close-icon" viewBox="64 64 896 896" focusable="false" data-icon="close" width="1em" height="1em" fill="currentColor" aria-hidden="true"><path d="M563.8 512l262.5-312.9c4.4-5.2.7-13.1-6.1-13.1h-79.8c-4.7 0-9.2 2.1-12.3 5.7L511.6 449.8 295.1 191.7c-3-3.6-7.5-5.7-12.3-5.7H203c-6.8 0-10.5 7.9-6.1 13.1L459.4 512 196.9 824.9A7.95 7.95 0 00203 838h79.8c4.7 0 9.2-2.1 12.3-5.7l216.5-258.1 216.5 258.1c3 3.6 7.5 5.7 12.3 5.7h79.8c6.8 0 10.5-7.9 6.1-13.1L563.8 512z"></path></svg>
        </div>
        <div class="modal-content">
        </div>
     </div>`;
  document.body.appendChild(modal);
  var modalOverlay = document.createElement("div");
  modalOverlay.className = "md-overlay";
  document.body.appendChild(modalOverlay);
}
var sliderType = $("#changa-slider").attr("slider-type");
$(window).on("load", function () {
  //insert changa cads
  document.querySelector("head").innerHTML += `
<style >
.modal-content-item {
  width:${sliderType == "vertical" ? "100% !important;" : "100%;"}
  display:flex !important;
  flex-direction:row-reverse;
  background:transparent;
}
</style>`;
  document.querySelector("#changa-slider").innerHTML = `
<div class="changa-main">
<div class="changa-card-container">
</div>
<div class="footer"><img height="22px" width="22px" alt="Changa logo" src="https://cdn-bz.changa.in/bz_uploads/staging/admin/2020-09-10/1599746014793_39865594.png" alt=""> Powered by Changa</div>
`;
  var $window = $(window);
  var zero = 0;
  addVideoCard();
});

function startCrausal() {
  var slider = $(".changa-card-container");
  slider.slick({
    dots: false,
    lazyLoad: "ondemand",
    arrows: true,
    speed: 400,
    slidesToShow: 5 * page,
    slidesToScroll: 4,
    variableWidth: true,
    autoplay: false,
    prevArrow: `<div class="fa fa-chevron-left">
                <img height= "40px" width="40px" class="prev" src="https://cdn-bz.changa.in/bz_uploads/admin/2021-02-04/1612419589800_841857806.png" />
            </div>`,
    nextArrow: `<div class="fa fa-chevron-right">
                <img height= "40px" width="40px" class="next" src="https://cdn-bz.changa.in/bz_uploads/admin/2021-02-04/1612419606655_473949803.png" />
            </div>`,
    pauseOnHover: false,
    pauseOnFocus: false,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          dots: false,
          variableWidth: true,
        },
      },
      {
        breakpoint: 600,
        settings: {
          // slidesToShow: 2,
          slidesToScroll: 2,
          dots: false,
          variableWidth: true,
        },
      },
      {
        breakpoint: 440,
        settings: {
          // slidesToShow: 1,
          slidesToScroll: 1,
          dots: false,
          variableWidth: true,
        },
      },
    ],
  });
  slider.on("wheel", function (e) {
    e.preventDefault();
    if (e.originalEvent.deltaX > 0) {
      $(this).slick("slickNext");
    } else {
      $(this).slick("slickPrev");
    }
  });
}
function renderCard(data) {
  var changaCardContainerElement = "";
  var skip = page <= 1 ? 0 : (page - 1) * limit - 10;
  console.log(skip + "skip");
  data.map(function (d, index) {
    var temp = d.videoUrl;
    if (index != 0 && index % 4 == 0) {
      temp =
        "https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4";
    }
    changaCardContainerElement += `
                    <div class="changa-card-container-item" data=${
                      index + skip
                    } onmouseover="onMouseOver(this)" 
                    onmouseout="onMouseOut(this)"
                    onclick="openVideoModal(this)">
                    <div class="description">
                            <p>${
                              d.description.length > 50
                                ? d.description.slice(0, 50) + "..."
                                : d.description
                            }</p>
                    </div> 
                    <video preload="none" poster=${
                      d.thumUrl
                    } playsinline loop="" id="multiVideo${
      index + skip
    }" muted="true" class="video-player" src=${temp}></video>
                    </div>
                `;
  });

  if (page <= 1) {
    $(".changa-card-container").append(changaCardContainerElement);
  } else {
    $(".changa-card-container").slick("slickAdd", changaCardContainerElement);
  }
}
function getHashTagData(hashtag) {
  //console.log('hashtag>>>>>>>>>',hashtag)

  $.get(
    `https://api-cdn.changa.in/api/v1/hashtag/video/${hashtag.join()}?page=${page}&limit=${limit}`,
    function (data) {
      if (data.data.length == 0) {
        noData = true;
      } else {
        videos = [...videos, ...data.data];
        // 		  	console.log(page,videos,data.data);
        renderCard(data.data);
        onModalOpenAddContent(data.data);
      }
    }
  )
    .fail(function () {
      $(".changa-card-container").append(
        `<h1 style="color:#333"> some thing went wrong </h1>`
      );
    })
    .done(function () {
      if (page <= 1) {
        startCrausal();
        initialiseModal();
      } else {
        // 			console.log("slicked");
        // 			$('.changa-card-container').slick("unslick");
        //  			$('.modal-content').slick("unslick");
        //  			startCrausal();
      }
    });
}
function getUserData(channel) {
  //console.log('channel>>>>>>>>>',channel)
  $.get(
    `https://api-cdn.changa.in/api/v1/user/username/${channel}`,
    function (data) {
      $.get(
        `https://api-cdn.changa.in/api/v1/video/user/${data.data.id}?page=${page}&limit=${limit}`,
        function (data) {
          if (data.data.length == 0) {
            noData = true;
          } else {
            videos = [...videos, ...data.data];
            // 		  		  console.log(page,videos,data.data);
            renderCard(data.data);
            onModalOpenAddContent(data.data);
          }
        }
      )
        .fail(function () {
          $(".changa-card-container").append(
            `<h3 style="color:#333"> some thing went wrong </h3>`
          );
        })
        .done(function () {
          if (page <= 1) {
            startCrausal();
            initialiseModal();
          }
        });
    }
  ).fail(function () {
    $(".changa-card-container").append(
      `<h3 style="color:#333" > some thing went wrong </h3>`
    );
  });
}
function addVideoCard() {
  // add video card in card-body WITH CRASOUL
  $.get(
    `https://apiv2.changa.in/api/v1/changa-lite/feed/${appId}`,
    function (data) {
      //console.log(data, data.data);
      if (data.data.feedType === "hashtag" || data.data.type === "hashtag") {
        getHashTagData(
          data.data.hashtag ? data.data.hashtag : data.data.hashtags
        );
      } else {
        let channel = data.data.channel
          ? data.data.channel[0]
          : data.data.users[0];
        // console.log(channel)
        getUserData(channel);
      }
    }
  ).fail(function () {
    $(".changa-card-container").append(
      `<h3 style="color:#333"> some thing went wrong </h3>`
    );
  });
}

function onModalOpenAddContent(data) {
  var modelContentItem = "";
  var skip = page <= 1 ? 0 : (page - 1) * limit - 10;
  console.log(skip);
  data.map(function (d, index) {
    modelContentItem += `
    <div class="modal-content-item">
        <div class="description">
           <p>${
             d.description.length > 200
               ? d.description.slice(0, 200) + "..."
               : d.description
           }</p>
           <div class="user-info">
                <img height = "45px" width="45px" src=${
                  d.user.profilePicUrl ||
                  "https://cdn-bz.changa.in/bz_uploads/admin/2021-01-29/1611931654918_221466120.png"
                }>
                <a href="${WEBSITE_URL}/app/userdetails?userid=${
      d.user.id
    }" style="color:#fff"> 
<span class="name"> ${
      d.user.firstName || "" + " " + d.user.lastname || ""
    } </span>
</a>
           </div>
         </div>  
         <div class="video-container"> 
         <div class="video-slider"> 
         <div class="fa fa-chevron-left">
         <img  height="40px" width="40px" onclick="slickPrev(this)" src="https://cdn-bz.changa.in/bz_uploads/admin/2021-02-04/1612419589800_841857806.png" />
     </div>
         ${
           window.innerWidth > 900
             ? `<video preload="none" disablepictureinpicture controlslist="nodownload"  controls playsinline loop="false" id="video${
                 index + skip
               }" class="video-player" id="video" src=${d.videoUrl}></video>`
             : ` <video preload="none" disablepictureinpicture controlslist="nodownload" playsinline loop="false" ondblclick="playPouse(this)" id="video${
                 index + skip
               }" class="video-player" id="video" src=${d.videoUrl}></video>`
         } 
         <div class="fa fa-chevron-right">
         <img height="40px" width="40px" onclick="slickNext()" src="https://cdn-bz.changa.in/bz_uploads/admin/2021-02-04/1612419606655_473949803.png" />
     </div>
         </div>
         </div>
    </div>
`;
  });
  if (page <= 1) $(".modal-content").append(modelContentItem);
  else $(".modal-content").slick("slickAdd", modelContentItem);
}

function slickPrev() {
  $(".modal-content").slick("slickPrev");
}
function slickNext() {
  $(".modal-content").slick("slickNext");
}
function openVideoModal(el) {
  let index = $(el).attr("data");
  let selected = videos[index];
  if (window.innerWidth < 900) {
    // console.log(appId);
    window.location.href = `https://changa.in/app/changa-lite?appid=${appId}&selected=${index}`;
    return;
  }
  $(".md-modal").addClass("md-show");
  if ($(".modal-content").children().length) {
    $(".modal-content").slick("slickGoTo", index);
  } else {
    onModalOpenAddContent(videos);
    //console.log(sliderType);
    initialiseModal();
    $(".modal-content").slick("slickGoTo", index);
    $(`#video${index}`)[0].play();
  }
}

function initialiseModal() {
  console.log("modalInitialised");
  var sliderProps = {
    lazyLoad: "ondemand",
    dots: false,
    arrows: false,
    speed: 0,
    touchThreshold: 200,
    swipe: true,
    swipeToSlide: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: false,
    prevArrow: `
            <div class="fa fa-chevron-left">
                <img height="40px" width="40px" class="prev" src="https://cdn-bz.changa.in/bz_uploads/admin/2021-02-04/1612419589800_841857806.png" />
            </div>
            `,
    nextArrow: `
            <div class="fa fa-chevron-right">
                <img height="40px" width="40px" class="prev" src="https://cdn-bz.changa.in/bz_uploads/admin/2021-02-04/1612419589800_841857806.png" />
            </div>
            `,
    autoplaySpeed: 3000,
    pauseOnHover: false,
    pauseOnFocus: false,
  };
  if (sliderType === "vertical") {
    sliderProps = { ...sliderProps, vertical: true, verticalSwiping: true };
    $(".modal-content").addClass("vertical");
  }
  $(".modal-content").slick({ ...sliderProps });
}

$(".modal-content").on(
  "beforeChange",
  function (event, slick, currentSlide, nextSlide) {
    $(`#video${currentSlide}`)[0].pause();
    //if current video is mutted all video play on mutted stage
    $(`#video${nextSlide}`)[0].muted = $(`#video${currentSlide}`)[0].muted;
    $(`#video${nextSlide}`)[0].play();
    $(`#video${nextSlide + 1}`).prop("preload", "auto");
    $(`#video${currentSlide - 1}`).prop("preload", "auto");
  }
);

$(".modal-content").on(
  "afterChange",
  function (event, slick, currentSlide, nextSlide) {
    if (!noData) {
      // console.log(currentSlide,videos.length,page);
      $(".modal-content .slick-active:eq(" + slick.currentSlide + ")")
        .addClass("slick-current")
        .siblings()
        .removeClass("slick-current");
      if (videos.length - currentSlide <= 10) {
        page = page + 1;
        limit = 20;
        addVideoCard();
      }
    }
  }
);

$(".changa-card-container").on(
  "afterChange",
  function (event, slick, currentSlide, nextSlide) {
    if (!noData) {
      // console.log(currentSlide,videos.length,page);
      $(".changa-card-container .slick-active:eq(" + slick.currentSlide + ")")
        .addClass("slick-current")
        .siblings()
        .removeClass("slick-current");
      if (videos.length - currentSlide <= 10) {
        page = page + 1;
        limit = 20;
        addVideoCard();
      }
    }
  }
);

$(".md-close-icon").on("click", function () {
  //pause video which is currently playing
  let video = $(
    ".modal-content-item.slick-slide.slick-current.slick-active video"
  );
  video[0].pause();
  $(".md-modal").removeClass("md-show");
});

////////////////////////////////////////
function playPouse(obj) {
  //console.log("playpause");
  if (obj.paused) {
    obj.play();
    obj.classList.toggle("pause");
  } else {
    obj.pause();
    //console.log("pause");
    obj.classList.toggle("pouse");
    // obj.prop('controls',false);
  }
}
function onMouseOver(el) {
  let index = $(el).attr("data");
  let selector = $(`#multiVideo${index}`);
  selector[0].play();
}
function onMouseOut(el) {
  let index = $(el).attr("data");
  let selector = $(`#multiVideo${index}`);
  selector[0].pause();
}
