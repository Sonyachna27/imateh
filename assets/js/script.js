document.addEventListener("DOMContentLoaded", function () {
  toggleMenu();
	openVideo ();	
	hideStickyButtonOnScroll();
	prettyScroll();
	hideSubcategoryItem();
	teamSliderInit();
	individualSliderInit();
	openTabs();
	updateHeight();
	accordionFunction();
	initDesktopHover();
    initMobileAccordion();
		openImageTabs();
		initCounterHover();
		updateFormProgress(1); //функция для прогресс бара
		initAllScrollAnimations();
});
const initCounterHover = () => {
    const allCounterBlocks = document.querySelectorAll('.counter__content');

    allCounterBlocks.forEach(block => {
        const textItems = block.querySelectorAll('.counter__content__item');
        const knobs = block.querySelectorAll('.knob');
        const svgItems = block.querySelectorAll('.item');
        const images = block.querySelectorAll('.counter-img:not(.counter-img-main)'); 
        const mainImage = block.querySelector('.counter-img-main'); 
        
        const allGroups = [textItems, knobs, svgItems, images];

        const activate = (index) => {
            if (mainImage) {
                mainImage.classList.add('unactive');
                mainImage.classList.remove('active');
            }

            allGroups.forEach(group => {
                group.forEach((el, i) => {
                    if (i === index) {
                        el.classList.add('active');
                        el.classList.remove('unactive');
                    } else {
                        el.classList.add('unactive');
                        el.classList.remove('active');
                    }
                });
            });
        };

        const reset = () => {
            if (mainImage) {
                mainImage.classList.remove('unactive');
                mainImage.classList.add('active'); 
            }

            allGroups.forEach(group => {
                group.forEach(el => {
                    el.classList.remove('active');
                    el.classList.remove('unactive');
                });
            });
        };

        [textItems, knobs].forEach(group => {
            group.forEach((item, index) => {
                item.addEventListener('mouseenter', () => activate(index));
                item.addEventListener('click', () => activate(index));
            });
        });

        block.addEventListener('mouseleave', reset);
        
        
        reset();
    });
};

const windowLoad = () =>{
  const animationDuration = 3000;
  const frameDuration = 1000 / 60;
  const totalFrames = Math.round(animationDuration / frameDuration);
  const easeOutQuad = t => t * (2 - t);

  const numScroll = (statValue) => {
    if (statValue.classList.contains('animated')) return;
    statValue.classList.add('animated');

    const targetAttr = statValue.dataset.target || statValue.innerText;
    const countTo = parseInt(targetAttr.replace(/,/g, ''), 10);
    
    const tempText = statValue.innerHTML;
    statValue.innerHTML = countTo;
    const maxWidth = statValue.offsetWidth;
    statValue.innerHTML = tempText;
    statValue.style.width = maxWidth + 'px';
    statValue.style.display = 'inline-block';

    let frame = 0;
    const counter = setInterval(() => {
      frame++;
      const progress = easeOutQuad(frame / totalFrames);
      const currentCount = Math.round(countTo * progress);

      statValue.innerHTML = currentCount;

      if (frame === totalFrames) {
        clearInterval(counter);
        statValue.innerHTML = countTo;
      }
    }, frameDuration);
  };

  const observerOptions = {
    threshold: 0.5, // Спрацює, коли 50% елемента видно
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        // Якщо це контейнер (таб або секція), шукаємо числа всередині
        const statValues = entry.target.querySelectorAll('.stat-value');
        if (statValues.length) {
          statValues.forEach(numScroll);
        } 
        // Якщо ми повісили observer прямо на .stat-value
        else if (entry.target.classList.contains('stat-value')) {
          numScroll(entry.target);
        }
        
        // Можна відписатися від спостереження, якщо анімація одноразова
        // observer.unobserve(entry.target); 
      }
    });
  }, observerOptions);


  document.querySelectorAll('.counter__content, .counter__content__item').forEach(el => {
    observer.observe(el);
  });
}


window.addEventListener('load', windowLoad);


const updateFormProgress = (step) => {
    const progressContainer = document.querySelector('.form__block__progress');
    if (!progressContainer) return;

    // Отримуємо загальну кількість кроків
    const totalSteps = parseInt(progressContainer.dataset.totalSteps) || 5;
    
    // Розрахунок відсотка
    const percent = Math.round((step / totalSteps) * 100);

    // Знаходимо елементи
    const stepText = document.getElementById('current-step');
    const totalText = document.getElementById('total-steps-display');
    const percentText = document.getElementById('progress-percent');
    const fill = document.getElementById('progress-fill');

    // Оновлюємо дані
    if (stepText) stepText.innerText = step;
    if (totalText) totalText.innerText = totalSteps;
    if (percentText) percentText.innerText = percent + '%';

    if (fill) {
        // Змінюємо ширину fill
        fill.style.width = `${percent}%`;
    }
};


const updateHeight = () =>{

const parent = document.querySelector('.chief-bg');
const childImg = document.querySelector('.chief__img');
if(!parent || !childImg) return;
if(innerWidth >= 1024) return;
function updateHeight() {
  if (parent && childImg) {
    const imgHeight = childImg.offsetHeight;
    parent.style.setProperty('--img-height', `${imgHeight}px`);
  }
}

window.addEventListener('resize', updateHeight);
window.addEventListener('load', updateHeight);
}


const hideSubcategoryItem = () => {
  const steps = document.querySelectorAll('.sub__item');
  if (!steps.length) return;
  steps.forEach(step => {
    const content = step.querySelector('.sub__item__bottom');
    gsap.set(content, { height: 0, opacity: 0, overflow: "hidden" });
  });

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
     
      if (entry.isIntersecting) {
        const targetStep = entry.target;
        
        steps.forEach((step) => {
          const content = step.querySelector('.sub__item__bottom');
          
          if (step === targetStep) {
            step.classList.add('is-active');
            gsap.to(content, {
              height: "auto", // GSAP сам вирахує scrollHeight
              opacity: 1,
              duration: 0.6,
              ease: "power2.out",
              overwrite: true,
							onUpdate: ScrollTrigger.refresh
            });
          } else {
            step.classList.remove('is-active');
            gsap.to(content, {
              height: 0,
              opacity: 0,
              duration: 0.4,
              ease: "power2.inOut",
              overwrite: true,
							onUpdate: ScrollTrigger.refresh
            });
          }
        });
      }
    });
  }, {
    // Зона спрацювання: -30% зверху і знизу екрана (тобто центр)
    rootMargin: '-30% 0px -30% 0px',
    threshold: 0
  });

  steps.forEach(step => observer.observe(step));
}


// document.addEventListener("DOMContentLoaded", () => {
//   gsap.registerPlugin(ScrollTrigger);

//   const items = gsap.utils.toArray('.sub__item');
//   let activeItem = null;

//   items.forEach((item) => {
//     const content = item.querySelector('.sub__item__bottom');
    
//     // Скидаємо стилі, щоб GSAP мав чистий старт
//     gsap.set(content, { height: 0, opacity: 0, overflow: 'hidden' });

//     ScrollTrigger.create({
//       trigger: item,
//       start: "top 60%", 
//       end: "bottom 40%",
//       // fastScrollEnd: true — запобігає "зависанню" анімацій при швидкому скролі
//       fastScrollEnd: true,
//       onEnter: () => activate(item),
//       onEnterBack: () => activate(item),
//     });
//   });

//   function activate(item) {
//     if (activeItem === item) return;

//     // 1. Закриваємо попередній елемент
//     if (activeItem) {
//       const prevContent = activeItem.querySelector('.sub__item__bottom');
//       activeItem.classList.remove('is-active');
//       gsap.to(prevContent, { 
//         height: 0, 
//         opacity: 0, 
//         duration: 0.3, 
//         ease: "power1.inOut",
//         overwrite: true 
//       });
//     }

//     // 2. Відкриваємо новий елемент
//     item.classList.add('is-active');
//     const content = item.querySelector('.sub__item__bottom');
    
//     gsap.to(content, {
//       height: 'auto',
//       opacity: 1,
//       duration: 0.5,
//       ease: "power2.out",
//       overwrite: true,
//       // Refresh виконуємо ТІЛЬКИ після завершення, щоб не було сіпання під час руху
//       onComplete: () => ScrollTrigger.refresh()
//     });

//     activeItem = item;
//   }
// });


// document.addEventListener("DOMContentLoaded", () => {
//   gsap.registerPlugin(ScrollTrigger, ScrollToPlugin);

//   const items = gsap.utils.toArray('.sub__item');
//   let activeItem = null;
//   let isAutoScrolling = false;

//   items.forEach((item) => {
//     const content = item.querySelector('.sub__item__bottom');
//     gsap.set(content, { height: 0, opacity: 0, overflow: 'hidden' });

//     ScrollTrigger.create({
//       trigger: item,
//       start: "top 60%", 
//       end: "bottom 40%",
//       onEnter: () => !isAutoScrolling && activate(item),
//       onEnterBack: () => !isAutoScrolling && activate(item),
//     });
//   });

//   function activate(item) {
//     if (activeItem === item) return;

//     // Закриваємо попередній
//     if (activeItem) {
//       const prevContent = activeItem.querySelector('.sub__item__bottom');
//       activeItem.classList.remove('is-active');
//       gsap.to(prevContent, { height: 0, opacity: 0, duration: 0.3, overwrite: true });
//     }

//     item.classList.add('is-active');
//     const content = item.querySelector('.sub__item__bottom');
//     gsap.to(content, {
//       height: 'auto',
//       opacity: 1,
//       duration: 0.6,
//       ease: "power2.out",
//       overwrite: true,
//       onUpdate: () => {
//         if (!isAutoScrolling) ScrollTrigger.refresh();
//       },
//       onComplete: () => ScrollTrigger.refresh()
//     });

//     activeItem = item;
//   }
// });




// const hideSubcategoryItem = () => {
//   const steps = document.querySelectorAll('.sub__item');

//   const observer = new IntersectionObserver(
//   (entries) => {
//     entries.forEach(entry => {
//       if (entry.isIntersecting && entry.intersectionRatio > 0) {
//         const index = Number(entry.target.dataset.step);

//         steps.forEach((step, i) => {
//           const content = step.querySelector('.sub__item__bottom');

//           if (i === index) {
//             step.classList.add('is-active');
//             content.style.maxHeight = content.scrollHeight + "px";
//           } else {
//             step.classList.remove('is-active');
//             content.style.maxHeight = "0";
//           }
//         });
//       }
//     });
//   },
//   {
//     rootMargin: '-20% 0px -20% 0px', 
//     threshold: 0.1 
//   }
// );


//   steps.forEach(step => observer.observe(step));
// }



// const toggleMenu = () => {
//   const htmlElement = document.querySelector("html");
//   const burgerMenus = document.querySelectorAll(".burger");
// 	const closeBurger = document.querySelector(".close");
//   if (!burgerMenus.length) return;

//   const navLinks = document.querySelectorAll("nav a");

//   burgerMenus.forEach((burgerMenu) => {
//     burgerMenu.addEventListener("click", (event) => {
//       event.stopPropagation();
//       htmlElement.classList.toggle("open");
//     });
//   });
// 	// closeBurger.addEventListener("click", (event) =>{
// 	// 	htmlElement.classList.remove("open");
// 	// });
//   navLinks.forEach((link) => {
//     link.addEventListener("click", () => {
//       htmlElement.classList.remove("open");
//     });
//   });
// };

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

const teamSliderInit = () => {
  const teamSlider = document.querySelector('.teamSlider');
  if (!teamSlider) return;

  const teamSliderSwiper = new Swiper(teamSlider, {
    slidesPerView: 1,
    spaceBetween: 16,
    watchOverflow: true,

    breakpoints: {
      320: {
        slidesPerView: 1,
      },
      480: {
        slidesPerView: 1,
        spaceBetween: 23,
      },
      640: {
        slidesPerView: 2,
        spaceBetween: 23,
      },
      1024: {
        slidesPerView: 3,
        spaceBetween: 23,
      }
    },

    navigation: {
      nextEl: ".team-button-next",
      prevEl: ".team-button-prev",
    },
  });
};


const individualSliderInit = () => {
  const individualSlider = document.querySelector('.individualSlider');
  if (!individualSlider) return;

  const slides = individualSlider.querySelectorAll('.swiper-slide');
  const paginationContainer = document.querySelector('.individual-pagination');
  if (!paginationContainer || !slides.length) return;

  paginationContainer.innerHTML = '<span class="pagination-dot"></span>';
  slides.forEach(() => {
    const step = document.createElement('span');
    step.classList.add('pagination-step');
    paginationContainer.appendChild(step);
  });
  paginationContainer.insertAdjacentHTML('beforeend', '<span class="pagination-dot"></span>');

  const steps = paginationContainer.querySelectorAll('.pagination-step');

  const swiper = new Swiper(individualSlider, {
    direction: 'horizontal',
    slidesPerView: 1,
    spaceBetween: 16,
    autoHeight: true,
    grabCursor: true,
    watchSlidesProgress: true,     
    mousewheel: {
      forceToAxis: true,
      sensitivity: 1,
      releaseOnEdges: true,  
    },

    keyboard: {
      enabled: true,
    },

    breakpoints: {
      1024: {
        direction: 'vertical',
        spaceBetween: 23,
      },
    },
  
    on: {
				breakpoint() {
					ScrollTrigger.refresh();
				},

      slideChange: function() {
				ScrollTrigger.refresh();
        steps.forEach((step, i) => {
          step.classList.toggle('is-active', i === this.activeIndex);
        });
      },
      
      setTranslate: function() {
        const prg = Math.max(0, Math.min(1, this.progress)); 
        
        paginationContainer.style.setProperty('--progress', prg);
        
        const activeIndex = Math.round(prg * (slides.length - 1));
        
        if (activeIndex >= 0 && activeIndex < steps.length) {
          steps.forEach((step, i) => {
            step.classList.toggle('is-active', i === activeIndex);
          });
        }
      }
    }
  });

  steps.forEach((step, index) => {
    step.addEventListener('click', () => swiper.slideTo(index));
  });
};

const openTabs = () => {
  const tabGroups = document.querySelectorAll(".implant__tabs");

  tabGroups.forEach((group) => {
    const tabsLinks = group.querySelectorAll(".implant__list-item");
    const allContentBlocks = group.querySelectorAll(".implant__content");
    let frontBlockId = tabsLinks[0].dataset.name;

    function addTabsActive() {
      tabsLinks.forEach((button, index) => {
        button.addEventListener("click", () => {
          if (button.classList.contains("active")) return;

          showContent(button.dataset.name, index);
        });
      });
    }

    function updateActiveTab(index) {
      tabsLinks.forEach((button, i) => {
        button.classList.toggle("active", i === index);
      });
    }

    function changeSlide(blockId) {
      allContentBlocks.forEach((block) => {
        if (block.getAttribute("id") === blockId) {
          block.classList.add("active");
        } else {
          block.classList.remove("active");
        }
      });
      frontBlockId = blockId;
    }
    function showContent(itemName, index) {
      changeSlide(itemName);
      updateActiveTab(index);
    }
    addTabsActive();
    showContent(frontBlockId, 0);
  });
};
const openImageTabs = () => {
  const tabGroups = document.querySelectorAll(".target__wrap");

  tabGroups.forEach((group) => {
    const tabsLinks = group.querySelectorAll(".target__list-item");
    const allContentBlocks = group.querySelectorAll(".target__content");
    let frontBlockId = tabsLinks[0].dataset.name;

    function addTabsActive() {
      tabsLinks.forEach((button, index) => {
        button.addEventListener("click", () => {
          if (button.classList.contains("active")) return;

          showContent(button.dataset.name, index);
        });
      });
    }

    function updateActiveTab(index) {
      tabsLinks.forEach((button, i) => {
        button.classList.toggle("active", i === index);
      });
    }

    function changeSlide(blockId) {
      allContentBlocks.forEach((block) => {
        if (block.getAttribute("id") === blockId) {
          block.classList.add("active");
        } else {
          block.classList.remove("active");
        }
      });
      frontBlockId = blockId;
    }
    function showContent(itemName, index) {
      changeSlide(itemName);
      updateActiveTab(index);
    }
    addTabsActive();
    showContent(frontBlockId, 0);
  });
};

const initDesktopHover = () => {
    const menuWrap = document.querySelector('.menu__wrap');
    if (!menuWrap) return;

    const menuItems = menuWrap.querySelectorAll('.menu-item');
    if (!menuItems.length) return;

    const firstMenuItem = menuItems[0];
    let firstHover = true;

    const setFirstOpen = () => firstMenuItem.classList.add('open-first');
    const removeFirstOpen = () => firstMenuItem.classList.remove('open-first');

    setFirstOpen();

    menuWrap.addEventListener('mousemove', (e) => {
        if (window.innerWidth < 1024) return;

        const targetLi = e.target.closest('.menu-item');
        if (targetLi) {
            removeFirstOpen();
            firstHover = false;
        } else if (!firstHover) {
            setFirstOpen();
            firstHover = true;
        }
    });

    menuWrap.addEventListener('mouseleave', () => {
        if (window.innerWidth < 1024) return;
        setFirstOpen();
        firstHover = true;
    });
};

const initMobileAccordion = () => {
    const menuItems = document.querySelectorAll('.menu-item-has-children');
    
    menuItems.forEach(item => {
        item.addEventListener('click', (e) => {
            if (window.innerWidth >= 1024) return; 
            if (e.target.tagName === 'A') {
                return; 
            }

            e.preventDefault();
            e.stopPropagation();

            const isActive = item.classList.contains('active');

            document.querySelectorAll('.menu-item-has-children.active').forEach(activeItem => {
                if (activeItem !== item) activeItem.classList.remove('active');
            });

            if (isActive) {
                item.classList.remove('active');
            } else {
                item.classList.add('active');
            }
        });
    });
};

const toggleMenu = () => {
    const htmlElement = document.querySelector("html");
    const burgerMenus = document.querySelectorAll(".burger");
    const navLinks = document.querySelectorAll("nav a:not(.menu-item-has-children > a)");

    if (!burgerMenus.length) return;

    burgerMenus.forEach((burgerMenu) => {
        burgerMenu.addEventListener("click", (e) => {
            e.stopPropagation();
            htmlElement.classList.toggle("open");
        });
    });

    navLinks.forEach((link) => {
        link.addEventListener("click", () => {
            htmlElement.classList.remove("open");
        });
    });
};

window.addEventListener('resize', () => {
    if (window.innerWidth > 1023) {
        document.querySelectorAll('.menu-item-has-children').forEach(el => {
            el.classList.remove('active');
        });
    }
});


 const initAllScrollAnimations = () => {
    gsap.registerPlugin(ScrollTrigger);

    
    const sections = document.querySelectorAll('.directions__wrap, .resource__content');

    sections.forEach(section => {
        const items = section.querySelectorAll('.list__item');
        if (!items.length) return;

        
        const directionX = section.classList.contains('wrap-reverse') ? -100 : 100;

        gsap.from(items, {
            scrollTrigger: {
                trigger: section, 
                start: "top 85%",
                toggleActions: "play none none none",
            },
            opacity: 0,
            x: directionX, 
            duration: 0.8,
            ease: "power2.out",
            stagger: 0.2
        });
    });
};