import React, {useState} from 'react'
import {Container, Grid} from "@material-ui/core";
import {Link} from "react-router-dom";

import makeStyles from "@material-ui/core/styles/makeStyles";

// import MainImage from '../../img/Main/19333428.jpg'
import MainImage from '../../img/Main/17973872.png'
import {forEach} from "react-bootstrap/ElementChildren";


const useStyles = makeStyles((theme) => ({
    root: {
        display: 'flex',
        flexWrap: 'wrap',
        justifyContent: 'center'
    },
    textField: {
        marginLeft: theme.spacing(1),
        marginRight: theme.spacing(1),
        width: '25ch',
    },
}));

let Main = (props) => {
    const classes = useStyles();
    const [dots, setDots] = useState([])

    const colors = ["#3CC157", "#2AA7FF", "#1B1B1B", "#FCBC0F", "#F85F36"];

    const numBalls = 50;
    const balls = [];

    for (let i = 0; i < numBalls; i++) {
        let ball = document.createElement("div");
        ball.classList.add("ball");
        ball.style.background = colors[Math.floor(Math.random() * colors.length)];
        ball.style.left = `${Math.floor(Math.random() * 100)}vw`;
        ball.style.top = `${Math.floor(Math.random() * 100)}vh`;
        ball.style.transform = `scale(${Math.random()})`;
        ball.style.width = `${Math.random()}em`;
        ball.style.height = ball.style.width;

        balls.push(ball);
        // document.body.append(ball);
        // setDots([...dots, {div: ball.outerHTML}])
        // console.log(dots)
    }

// Keyframes
    balls.forEach((el, i, ra) => {
        let to = {
            x: Math.random() * (i % 2 === 0 ? -11 : 11),
            y: Math.random() * 12
        };

        let anim = el.animate(
            [
                { transform: "translate(0, 0)" },
                { transform: `translate(${to.x}rem, ${to.y}rem)` }
            ],
            {
                duration: (Math.random() + 1) * 2000, // random duration
                direction: "alternate",
                fill: "both",
                iterations: Infinity,
                easing: "ease-in-out"
            }
        );
        // let test = el.outerHTML

    });

    // setDots([{balls: balls}])
    // console.log(balls)

    return (

        <main >
            <Container fixed>
                <Grid container  justify="center" className='main-block'>
                        <Grid item xs={6} className="main-right" style={{marginTop:75}}>
                            <h2 className='title'>Нестандартные вопросы?</h2>
                            <p className='subtitle'>И необычные вопросы ждут вас в этом приложении
                            начните прям сейчас!</p>
                            <button className='default-button btn-half'><Link className="link-default" to='/login'>Приступить</Link></button>
                        </Grid>
                        <Grid item xs={6}>
                            <img src={MainImage} width='600'/>
                        </Grid>
                </Grid>
            </Container>
            <footer >
               <Container >
                   <Grid xs={12} className='footer'>
                    <div className='social-block'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="36px" height="36px"><g fill="none" fillRule="evenodd"><path d="M-6-6h36v36H-6z"/><path fill="#424242" d="M8 6h20c1.1 0 2 .9 2 2v20c0 1.1-.9 2-2 2H8c-1.1 0-2-.9-2-2V8c0-1.1.9-2 2-2zm15.14
24v-9.12h3.24l.48-3.56h-3.72v-2.27c0-1.03.3-1.73 1.87-1.73h2v-3.18c-.95-.1-1.92-.14-2.9-.14-2.87
0-4.84 1.66-4.84 4.7v2.62H16v3.56h3.25V30h3.9z"/></g></svg>
                    </div>
                       <div className='social-block'>
                           <svg xmlns="http://www.w3.org/2000/svg" width="36px" height="36px">
                               <g fill="none" fillRule="evenodd">
                                   <path d="M-6-6h36v36H-6z"/><path fill="#424242" d="M18 6c-3.26 0-3.67.02-4.95.08-1.28.06-2.15.26-2.9.56-.8.3-1.47.7-2.14 1.38-.6.67-1 1.34-1.3 2.13-.3.76-.5 1.63-.5 2.9C6 14.35 6 14.75 6 18c0 3.26 0 3.67.07 4.95.06 1.28.26 2.15.56 2.9.3.8.72 1.47 1.38 2.14.7.6 1.4 1 2.2 1.3.8.3 1.7.5 2.9.5 1.3.04 1.7.05 5 .05s3.7 0 5-.08c1.28-.08 2.15-.28 2.9-.58.8-.3 1.47-.74 2.14-1.4.67-.68 1.08-1.35 1.38-2.14.3-.76.5-1.63.6-2.9.05-1.3.06-1.7.06-4.96s0-3.66-.07-4.94c-.06-1.3-.26-2.16-.56-2.9-.3-.8-.7-1.48-1.4-2.15-.7-.66-1.36-1.1-2.15-1.4-.77-.3-1.64-.5-2.9-.54H18zm0 2.17c3.2 0 3.58 0 4.84.07 1.17.05 1.8.25 2.23.4.56.23.96.5 1.38.9.42.43.68.83.9 1.4.16.4.36 1.05.4 2.22.07 1.26.08 1.64.08 4.84s0 3.6-.07 4.85c-.05 1.17-.25 1.8-.4 2.23-.23.56-.5.96-.9 1.38-.43.42-.83.68-1.4.9-.4.16-1.05.36-2.22.4-1.26.07-1.64.08-4.84.08s-3.6 0-4.85-.07c-1.17-.05-1.8-.25-2.23-.4-.56-.23-.96-.5-1.38-.9-.42-.43-.68-.83-.9-1.4-.16-.4-.36-1.05-.4-2.22-.07-1.26-.08-1.64-.08-4.85 0-3.2 0-3.58.07-4.84.05-1.17.25-1.8.4-2.23.23-.56.5-.96.9-1.38.43-.42.83-.68 1.4-.9.4-.16 1.05-.36 2.22-.4 1.26-.07 1.64-.08 4.85-.08zm-.1 13.7c-2.2 0-3.98-1.8-3.98-3.98 0-2.2 1.78-4 3.97-4 2.1 0 3.9 1.8 3.9 3.9 0 2.2-1.8 3.9-4 3.9zm0-10.1c3.36 0 6.1 2.74 6.1 6.12 0 3.3-2.74 6.1-6.1 6.1-3.4 0-6.12-2.8-6.12-6.1 0-3.4 2.73-6.2 6.1-6.2zm7.88-.1c0 .8-.65 1.44-1.45 1.44-.8 0-1.44-.6-1.44-1.4 0-.8.6-1.4 1.4-1.4.8 0 1.4.7 1.4 1.5z"/></g></svg>
                       </div>
                       <div className='social-block'>
                           <svg xmlns="http://www.w3.org/2000/svg" width="36px" height="36px"><g fill="none" fillRule="evenodd"><path d="M-6-6h36v36H-6z"/><path fill="#424242" d="M13.78 26.53c8.58 0 13.27-6.93 13.27-12.94V13c.9-.64 1.7-1.43
2.32-2.35-.85.37-1.76.6-2.68.72.95-.57 1.7-1.46 2.03-2.5-.92.52-1.92.9-2.96
1.1-1.45-1.5-3.75-1.88-5.6-.9-1.87.97-2.83 3.03-2.35 5.03-3.75-.18-7.25-1.9-9.62-4.74-1.22 2.07-.6
4.73 1.46 6.06-.74-.02-1.47-.2-2.12-.57v.06c0 2.18 1.57 4.05 3.74 4.48-.68.18-1.4.2-2.1.07.6 1.86
2.36 3.12 4.36 3.16-1.66 1.28-3.7 1.96-5.8 1.96-.37 0-.74-.02-1.1-.07 2.12 1.33 4.6 2.04 7.14 2.03"/></g></svg>
                       </div>
                       <div className='social-block'>
                           <svg xmlns="http://www.w3.org/2000/svg" width="36px" height="36px"><g fill="none" fillRule="evenodd"><path d="M-6-6h36v36H-6z"/><path fill="#424242" d="M28.07 6c.97 0 1.77.77 1.77 1.72v20.4c0 .94-.8 1.7-1.77 1.7H7.77c-.98 0-1.77-.76-1.77-1.7V7.7C6
6.77 6.8 6 7.76 6h20.3zM15.3 14.94V26.3h3.52v-5.6c0-1.48.28-2.92 2.12-2.92 1.8 0 1.84 1.7 1.84
3.02v5.53h3.53V20.1c0-3.06-.62-5.42-4.2-5.42-1.72 0-2.87.95-3.35 1.84h-.04v-1.56h-3.4zm-4-5.66c-1.13
0-2.05.92-2.05 2.05s.92 2.05 2.05 2.05 2.05-.92 2.05-2.05-.92-2.05-2.05-2.05zM9.53 26.3h3.54V14.95H9.53V26.3z"/></g></svg>
                       </div>
                   </Grid>
               </Container>
            </footer>
            <back id='back'>

            </back>

        </main>
    )
}

export default Main