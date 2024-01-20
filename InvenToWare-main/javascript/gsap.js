let icon_livechat = document.querySelector("#live_chat_icon");
let icon_livechat_close = document.querySelector("#live_chat_close");
let drag_container = document.querySelector('.drag-container');
let icon = document.querySelector(".icon");
let live_chat = document.querySelector('.livechat')
let logoimg = document.querySelector('.logo > img')
gsap.from(".icon", {
  duration: 1,
  scrollTrigger: {
    start: "105% center",
    scroller: "body",
    trigger: ".main_heropage",
    end: "350% center",
    scrub: 2,
  },
  ease: "back.out(1.7)",
  x: "110%",
  right: "-6vw",
}),
gsap.from(".icon", {
    scrollTrigger: {
      start: "5% center",
      scroller: "body",
      trigger: ".page3",
      end: "bottom center",
      onEnter: () => {
        gsap.to(icon, {
          opacity: 0,
          duration: 0.5,
          onComplete: () => {
            icon.style.display = "none"; // Hide the element after fading out
          },
        });
      },

      onLeaveBack: () => {
        gsap.to(icon, {
          opacity: 1,
          duration: 0.5,
        }),
          (icon.style.display = "block");
      },
    },
  });
  
  gsap.from(drag_container, {
    scrollTrigger: {
      start: "5% center",
      scroller: "body",
      trigger: ".page3",
      end: "bottom center",
      onEnter: () => {
        gsap.to(drag_container, {
          opacity: 0,
          duration: 0.5,
          onComplete: () => {
            
            drag_container.style.display = "none"; 
          },
        });
      },

      onLeaveBack: () => {
        gsap.to(drag_container, {
          opacity: 1,
          duration: 0.3,
         }),
          (
            drag_container.style.display = "block");
      },
    },
  });


icon_livechat.addEventListener('click',()=>{
  live_chat.style.zIndex = 5;
  drag_container.style.right = 0;

})
icon_livechat_close.addEventListener('click',()=>{
  live_chat.style.zIndex = 1;

  drag_container.style.right = '-40vw';

})




icon_livechat.addEventListener("click", () => {
  const timeline = gsap.timeline();

  timeline.to(icon_livechat, {
    duration: 0.3,
    x: "-1400%",

    rotation: 360,
    y: "-1510%",
    opacity:0,
  });
  timeline.to(icon_livechat_close, {
    opacity:1,
    
  });
});
icon_livechat_close.addEventListener("click", () => {
  const timeline2 = gsap.timeline();
  gsap.to(icon_livechat, {
    x: 0,
    y: 0,
  });
  timeline2.to(icon_livechat_close, {
    duration: 0.1,
    rotation: 360,
    
    opacity: 0,
  });
  timeline2.to(icon_livechat, {
    opacity: 1,
  });
});
logoimg.addEventListener('mouseenter',()=>{
  let tl = gsap.timeline();

  tl.to('.logo>h2',{
    duration:1,
  })
  tl.to('.logo>h2',{
    opacity:1,
    x:'60px',
  })
})
logoimg.addEventListener('mouseleave',()=>{
  let tl = gsap.timeline();
tl.to('.logo>h2',{
  x:'40px',
  duration:2,
})  
tl.to('.logo>h2',{
  opacity:0,

})
})
// icon_value = 0;
// }
// window.onload = () => {
//   let icon_value = 0;

//   if (icon_value == 0) {
  
//     icon_value = 1;
//   }
//   if (icon_value == 1) {
   
// };
