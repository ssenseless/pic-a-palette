import React from "react";
import './About.css';

class About extends React.Component{
    render(){
        return(
            <body>

                <section class="BodySectionAbout">
                    <div class="TitleDIV">
                        About the Website
                    </div>
                    <div class="AboutWebsite">
                    Pic-A-Palette is a fresh take on color palette generation that aids 
                    everyone - from artists to people interested in redesigning their homes - in 
                    getting the inspiration they need to strategize and finish their current project. 
                    Our product, unlike Coolors or Paletton, takes advantage of the user’s subconscious; 
                    allowing organic color combinations to be derived by our AI. which will represent the colors
                     the user, knowingly or unknowingly, wants to see put together. This will be done by the
                      user selecting a variety of pictures and afterwards the color palette would be generated
                    </div>
                </section>
            </body>

            
        )
    }
}

export default About;