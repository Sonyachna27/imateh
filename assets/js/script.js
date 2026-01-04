document.addEventListener("DOMContentLoaded", function () {
  toggleMenu();
	accordionFunction();
	openVideo ();	
	hideStickyButtonOnScroll();
	prettyScroll();
	hideSubcategoryItem();
});



// document.addEventListener("DOMContentLoaded", () => {
//   gsap.registerPlugin(ScrollTrigger);

//   const items = gsap.utils.toArray('.sub__item');
//   let activeItem = null;

//   function getStartOffset() {
//     // аналог rootMargin: -20%
//     return Math.round(window.innerHeight * 0.2);
//   }

//   items.forEach(item => {
//     const content = item.querySelector('.sub__item__bottom');

//     gsap.set(content, {
//       height: 0,
//       opacity: 0,
//       overflow: 'hidden'
//     });

//     ScrollTrigger.create({
//       trigger: item,
//       start: () => `top+=${getStartOffset()} center`,
//       onEnter: () => activate(item),
//       onEnterBack: () => activate(item),
//       invalidateOnRefresh: true
//     });
//   });

//   function activate(item) {
//     if (activeItem === item) return;

//     items.forEach(i => {
//       const c = i.querySelector('.sub__item__bottom');

//       if (i === item) {
//         i.classList.add('is-active');

//         gsap.to(c, {
//           height: c.scrollHeight,
//           opacity: 1,
//           duration: 0.45,
//           ease: 'power2.out',
//           overwrite: 'auto',
//           onComplete: () => {
//             gsap.set(c, { height: 'auto' });
//             ScrollTrigger.refresh();
//           }
//         });

//       } else {
//         i.classList.remove('is-active');

//         gsap.to(c, {
//           height: 0,
//           opacity: 0,
//           duration: 0.35,
//           ease: 'power2.inOut',
//           overwrite: 'auto'
//         });
//       }
//     });

//     activeItem = item;
//   }

//   // 🔒 refresh ТІЛЬКИ коли реально треба
//   window.addEventListener('orientationchange', () => {
//     ScrollTrigger.refresh();
//   });
// });




const hideSubcategoryItem = () => {
  const steps = document.querySelectorAll('.sub__item');

  const observer = new IntersectionObserver(
  (entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting && entry.intersectionRatio > 0) {
        const index = Number(entry.target.dataset.step);

        steps.forEach((step, i) => {
          const content = step.querySelector('.sub__item__bottom');

          if (i === index) {
            step.classList.add('is-active');
            content.style.maxHeight = content.scrollHeight + "px";
          } else {
            step.classList.remove('is-active');
            content.style.maxHeight = "0";
          }
        });
      }
    });
  },
  {
    rootMargin: '-20% 0px -20% 0px', 
    threshold: 0.1 
  }
);


  steps.forEach(step => observer.observe(step));
}



const toggleMenu = () => {
  const htmlElement = document.querySelector("html");
  const burgerMenus = document.querySelectorAll(".burger");
	const closeBurger = document.querySelector(".close");
  if (!burgerMenus.length) return;

  const navLinks = document.querySelectorAll("nav a");

  burgerMenus.forEach((burgerMenu) => {
    burgerMenu.addEventListener("click", (event) => {
      event.stopPropagation();
      htmlElement.classList.toggle("open");
    });
  });
	// closeBurger.addEventListener("click", (event) =>{
	// 	htmlElement.classList.remove("open");
	// });
  navLinks.forEach((link) => {
    link.addEventListener("click", () => {
      htmlElement.classList.remove("open");
    });
  });
};

const openVideo = () =>{
	
	const videoBox = document.querySelector('.video-box');
	if(!videoBox) return;
	const video = videoBox.querySelector('video');
	const playBtn = videoBox.querySelector('.video-play');

	playBtn.addEventListener('click', () => {
		video.play();
		videoBox.classList.add('playing');
		video.setAttribute('controls', 'controls');
	});

}

const hideStickyButtonOnScroll = () => {
  const container = document.querySelector('.btn-container');
  const section = document.querySelector('.connection');

  if (!container || !section) return;

  let lastScrollY = window.scrollY;

  const onScroll = () => {
    const rect = section.getBoundingClientRect();
    const currentScrollY = window.scrollY;

    if (currentScrollY > lastScrollY) {
      if (rect.top < window.innerHeight) {
        container.classList.add('is-hidden');
      }
    } else {
      if (rect.top >= 0 && rect.top < window.innerHeight) {
        container.classList.remove('is-hidden');
      }
    }

    lastScrollY = currentScrollY;
  };

  window.addEventListener('scroll', onScroll);

  const rect = section.getBoundingClientRect();
  if (rect.top < window.innerHeight && rect.bottom > 0) {
    container.classList.add('is-hidden');
  }
};

// const hideSubcategoryItem = () =>{
// 	const steps = document.querySelectorAll('.sub__item');

// const observer = new IntersectionObserver(
//   (entries) => {
//     entries.forEach(entry => {
//       if (entry.isIntersecting) {
//         const index = Number(entry.target.dataset.step);

//         steps.forEach((step, i) => {
//           step.classList.toggle('is-active', i === index);
//         });
//       }
//     });
//   },
//   {
//     rootMargin: '-50% 0px -50% 0px',
//     threshold: 0
//   }
// );

// steps.forEach(step => observer.observe(step));
// }

const prettyScroll = () => {
  document.querySelectorAll('a[href^="#"]').forEach(link => {
    link.addEventListener('click', (e) => {
      const id = link.getAttribute('href');

      if (id === '#' || !document.querySelector(id)) return;

      e.preventDefault();

      document.querySelector(id).scrollIntoView({
        behavior: 'smooth'
      });
    });
  });
};




// const openMenu = () => {
//   const windowWidth = window.innerWidth;
//   const menuLinks = document.querySelectorAll('header li:has(.sub-menu)');

//     menuLinks.forEach((link) => {
//       const subMenu = link.querySelector('.sub-menu');
//       if (!link.dataset.listener) {
//         link.addEventListener("click", (event) => {
//           event.stopPropagation();
//           link.classList.toggle("active");
//         });
//         link.dataset.listener = "true"; 
//       }
//     });
  
// };

const accordionFunction = () => {
  const accordionItems = document.querySelectorAll(".accord-item");
  accordionItems.forEach((item) => {
		const top = item.querySelector(".accord-item-top");
		if(top){
			top.addEventListener("click", function () {
				item.classList.toggle("active");
			});
		}
  });
};

