let mm = gsap.matchMedia();

mm.add("(min-width: 0px) and (max-width: 9999px)", () => {


    gsap.fromTo(".transform_xt", {
        x: -550,
    }, {
        x: -30,
        ease: "power2.out",
        scrollTrigger: {
            trigger: ".photo_collage",
            start: "top 100%",
            end: "bottom 0%",
            scrub: 2
        }
    });

    gsap.fromTo(".transform_xb", {
        x: 30,
    }, {
        x: -550,
        ease: "power2.out",
        scrollTrigger: {
            trigger: ".photo_collage",
            start: "top 100%",
            end: "bottom 0%",
            scrub: 2
        }
    });

});