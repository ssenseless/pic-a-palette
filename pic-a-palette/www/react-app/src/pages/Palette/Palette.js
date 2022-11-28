import React from "react";

import './Palette.css';

class Palette extends React.Component{
    render(){
        return(
            <body>
                <section class="BodySectionPalette">
                    <div class="TitleDIVPalette">
                        Creating a Pic-A-Pallete
                    </div>
                    <div class="SelectingBody">
                        <div></div>
                        <div class="Register">
                            <div class="Pictures">
                                <img src="2.jpg"/>
                            </div>
                            <div class="Buttons">
                                <div class="YesDIV">
                                    <button>Yes</button>
                                </div>
                                <div class="noDIV">
                                    <button>No</button>
                                </div>
                            </div>
                        </div>
                        <div></div>
                    </div>
                </section>
            </body>
        )
    }
}

export default Palette;
