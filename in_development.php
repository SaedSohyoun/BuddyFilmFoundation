<?php
include 'inc/header.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IN DEVELOPMENT</title>
</head>
<style>
* {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}

body {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    margin: auto;
    background-color: black;
    color: white;
    font-family: Arial, Helvetica, sans-serif;
    line-height: 1.6;
}

@font-face {
    font-family: Prism;
    src: url(./assets/Prism-Regular.otf);
}

h2 {
    color: #00A3A1;
    font-size: 3rem;
    font-weight: 500;
    font-family: Prism;
    line-height: 3.5rem;
    text-shadow: black 3px 0px 5px;
    margin-bottom: 0.5rem;
}

.developmentContainer {
    justify-content: center;
    align-items: center;
    width: 100%;
    min-height: 100vh;
    background-image: url('./uploads/indev/background.png');
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
}

.devHeader {
    background-image: url('./uploads/indev/devbg.png');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 30rem;
    box-shadow: #1b2e2e 0rem 4rem 10rem;
    position: relative;
}

.devHeader::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.3);
    z-index: 1;
}

.border {
    border: 0.1rem white solid;
    padding: 3rem;
    margin: auto;
    width: 40rem;
    position: relative;
    z-index: 2;
    backdrop-filter: blur(5px);
    background: rgba(0, 0, 0, 0.2);
}

.devHeader h1 {
    font-size: 4rem;
    font-family: Prism;
    font-weight: 100;
    margin-bottom: 1rem;
}

.devHeader p {
    font-size: 1.2rem;
    color: #00A3A1;
    font-weight: 600;
    letter-spacing: 2px;
}

.devBoxes {
    margin: 7rem auto;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    max-width: 1200px;
    padding: 0 2rem;
}

.devBox {
    display: flex;
    justify-content: center;
    margin: auto;
    flex-direction: row;
    background-color: rgba(255, 255, 255, 0.084);
    width: 100%;
    max-width: 70rem;
    min-height: 26rem;
    padding: 1.5rem;
    gap: 2rem;
    border-radius: 0.5rem;
    box-shadow: #000000 0rem 4rem 10rem;
    margin: 2rem auto;
    transition: all 0.3s ease;
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.devBox:hover {
    transform: translateY(-5px);
    box-shadow: #000000 0rem 6rem 15rem;
    border-color: rgba(0, 163, 161, 0.3);
}

.line {
    height: 0.5vh;
    width: 20vw;
    background-color: #00A3A1;
    border-radius: 5rem;
    margin: 1rem 0rem;
    max-width: 200px;
}

.projType {
    color: #00A3A1;
    font-weight: 600;
    font-size: 1.1rem;
    margin-bottom: 0.5rem;
}

.projDesc {
    color: white;
    font-size: 0.95rem;
    line-height: 1.7;
    margin-bottom: 1rem;
}

.imgwText {
    flex-shrink: 0;
}

.imgwText img {
    height: 21rem;
    width: 280px;
    object-fit: cover;
    border-top-right-radius: 1rem;
    border-bottom-right-radius: 1rem;
    transition: all 0.3s ease;
}

.devBox:hover .imgwText img {
    transform: scale(1.02);
}

.imgwText p {
    color: #00A3A1;
    margin: 1rem 0rem 2rem 1rem;
    font-size: 0.9rem;
    font-weight: 500;
}

.overalInfo {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

button {
    background-color: #00A3A1;
    border: none;
    color: white;
    margin: 2rem 0rem 1rem 0rem;
    padding: 0.8rem 3rem;
    border-radius: 0.3rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    align-self: flex-start;
}

button:hover {
    background-color: #008a88;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 163, 161, 0.3);
}

.projDescexc {
    margin-right: 6rem;
    line-height: 1.7;
}

/* Responsive Design */
@media (max-width: 1200px) {
    .devBox {
        max-width: 90%;
        padding: 1rem;
        gap: 1.5rem;
    }
    
    .imgwText img {
        width: 250px;
        height: 18rem;
    }
}

@media (max-width: 768px) {
    .devHeader h1 {
        font-size: 2.5rem;
    }
    
    .border {
        width: 90%;
        padding: 2rem;
    }
    
    .devBox {
        flex-direction: column;
        max-width: 95%;
        min-height: auto;
        padding: 1rem;
    }
    
    .imgwText img {
        width: 100%;
        height: 15rem;
        border-radius: 0.5rem;
    }
    
    .line {
        width: 100%;
        max-width: none;
    }
    
    .projDescexc {
        margin-right: 0;
    }
    
    button {
        align-self: center;
        width: 100%;
        max-width: 200px;
    }
    
    h2 {
        font-size: 2rem;
        line-height: 2.5rem;
    }
}

@media (max-width: 480px) {
    .devHeader {
        height: 20rem;
    }
    
    .devHeader h1 {
        font-size: 2rem;
    }
    
    .devBoxes {
        padding: 0 1rem;
        margin: 4rem auto;
    }
    
    .imgwText img {
        height: 12rem;
    }
}
</style>

<body>
    <main class="developmentContainer">
        <section class="devHeader">
            <!-- Add image in style css + the shadow. -->
            <div class="border">
                <h1>IN DEVELOPMENT</h1>
                <p>UPCOMING</p>
            </div>
        </section>

        <section class="devBoxes">

            <article class="devBox">
                <div class="imgwText">
                    <img src="./uploads/indev/ratproj.png" alt="">
                    <p>Written by Darina Dorogan</p>
                </div>
                <div class="overalInfo">
                    <h2>RAT</h2>
                    <p class="projType">Short Film</p>
                    <div class="line"></div>
                    <!-- Leave the line empty, styling will take care of it. -->
                    <p class="projDesc">
                        War and hunger forces kids to become adults; war changes even kids and steals
                        their childhood, their innocence. There are no good or bad personalities here. Just kids spoiled
                        by war. War is cruel and tries to kill the light of friendship and affection that ignites
                        between the characters.</p>
                    <button>Learn more</button>
                </div>
            </article>

            <article class="devBox">
                <div class="imgwText">
                    <img src="./uploads/indev/ourparadise.png" alt="">
                    <p>Written by Walid Taher & Curated by Marc Veerkamp</p>
                </div>
                <div class="overalInfo">
                    <h2>OUR PARADISE</h2>
                    <p class="projType">Feature Length</p>
                    <div class="line"></div>
                    <!-- Leave the line empty, styling will take care of it. -->
                    <p class="projDesc">
                        Karim's love is tested when his girlfriend Mary, arrives home with a dog. While
                        he begins to struggle with his identity, he unexpectedly finds himself in need of the unclean
                        animal.</p>
                    <button>Learn more</button>
                </div>
            </article>

            <article class="devBox">
                <div class="imgwText">
                    <img src="./uploads/indev/fa.png" alt="">
                    <p>Produced by: Buddy Film Productions / Buddy Film Foundation, <br> Dewi Reijs</p>
                </div>
                <div class="overalInfo">
                    <h2>TARA & FARZAD</h2>
                    <p class="projType">Feature Length</p>
                    <div class="line"></div>
                    <!-- Leave the line empty, styling will take care of it. -->
                    <p class="projDesc">
                        Farzad, an Iranian ex-refugee who is unhappily married to the boring Irene, risks his marriage
                        to be with the love of his life; the married one
                    </p>
                    <button>Learn more</button>
                </div>
            </article>

            <article class="devBox">
                <div class="imgwText">
                    <img src="./uploads/indev/post.png" alt="">
                    <p>Written by Dennis Overeem</p>
                </div>
                <div class="overalInfo">
                    <h2>POST VOOR AREND</h2>
                    <p class="projType">Short Film</p>
                    <div class="line"></div>
                    <!-- Leave the line empty, styling will take care of it. -->
                    <p class="projDesc">
                        Arend is often alone and finds it difficult to carry out all his plans. He finds his own way of
                        dealing with his loneliness by stealing his neighbours' mail and accepting invitations that are
                        not intended for him.
                    </p>
                    <button>Learn more</button>
                </div>
            </article>

            <article class="devBox">
                <div class="imgwText">
                    <img src="./uploads/indev/welkom.png" alt="">
                    <p>Written by Dennis Overeem</p>
                </div>
                <div class="overalInfo">
                    <h2>WELKOM</h2>
                    <p class="projType">Feature Length</p>
                    <div class="line"></div>
                    <!-- Leave the line empty, styling will take care of it. -->
                    <p class="projDesc">
                        The film Welkom aims to represent a side of the immigration that is not often portrayed by the
                        media. The dramatic feeling that we often attach to the word "refugee", Welkom aims to show with
                        real life stories, that it's not always like this. People are still able to laugh at their
                        misery and make the best out of it.
                    </p>
                    <button>Learn more</button>
                </div>
            </article>

            <article class="devBox">
                <div class="imgwText">
                    <img src="./uploads/indev/tussenlanding.png" alt="">
                    <p>Regie Dennis Overeem</p>
                </div>
                <div class="overalInfo">
                    <h2>TUSSENLANDING</h2>
                    <p class="projType">Documentary</p>
                    <div class="line"></div>
                    <!-- Leave the line empty, styling will take care of it. -->
                    <p class="projDescexc">
                        'Tussenlanding'; een tastbare herrinering aan tijdelijkheid. A documentary.
                    </p>
                    <button>Learn more</button>
                </div>
            </article>

        </section>
    </main>
</body>

</html>

<?php include 'inc/footer.php'; ?>