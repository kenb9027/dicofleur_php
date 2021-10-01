function moveBurger(x) {
  x.classList.toggle("change");
}

AOS.init();
document.addEventListener("DOMContentLoaded", () => {
  // Menu & Navbar
  const menuSide = document.querySelector("#menu-side");
  const burger = document.querySelector(".burger-container");

  burger.addEventListener("click", function (e) {
    e.preventDefault();
    menuSide.classList.toggle("menu-side-open");
  });

  // Game : mobile, click on picture to see names
  const gameCards = document.querySelectorAll(".game-card");

  gameCards.forEach((gameCard) => {
    const gameCardNames = gameCard.querySelector(".game-card-names");

    gameCard.addEventListener("click", function (c) {
      c.preventDefault();
      gameCardNames.classList.toggle("game-card-names-onclick");
      gameCardNames.classList.toggle("game-card-names-hover");
    });

  });
});
