document.addEventListener("DOMContentLoaded", function () {
  toggleMenu();
	accordionFunction();
	openVideo ();	
	hideStickyButtonOnScroll();
	prettyScroll();
	// hideSubcategoryItem();
});

document.addEventListener("DOMContentLoaded", () => {
  gsap.registerPlugin(ScrollTrigger, ScrollToPlugin);

  const items = gsap.utils.toArray('.sub__item');
  let activeItem = null;
  let isAutoScrolling = false;

  items.forEach((item) => {
    const content = item.querySelector('.sub__item__bottom');
    gsap.set(content, { height: 0, opacity: 0, overflow: 'hidden' });

    ScrollTrigger.create({
      trigger: item,
      start: "top 60%", 
      end: "bottom 40%",
      onEnter: () => !isAutoScrolling && activate(item),
      onEnterBack: () => !isAutoScrolling && activate(item),
    });
  });

  function activate(item) {
    if (activeItem === item) return;

    // Закриваємо попередній
    if (activeItem) {
      const prevContent = activeItem.querySelector('.sub__item__bottom');
      activeItem.classList.remove('is-active');
      gsap.to(prevContent, { height: 0, opacity: 0, duration: 0.3, overwrite: true });
    }

    item.classList.add('is-active');
    const content = item.querySelector('.sub__item__bottom');
    gsap.to(content, {
      height: 'auto',
      opacity: 1,
      duration: 0.6,
      ease: "power2.out",
      overwrite: true,
      onUpdate: () => {
        if (!isAutoScrolling) ScrollTrigger.refresh();
      },
      onComplete: () => ScrollTrigger.refresh()
    });

    activeItem = item;
  }
});




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

