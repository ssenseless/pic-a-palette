import React from "react";
import ImageSlider from "./Silders/ImageSlider";
import { SliderData } from "./Silders/SilderData";

class HomeFooter extends React.Component{
    render(){
        return(
            <footer class="FooterSection">
                <div class="FooterDIV">
                    <div class="FooterTitle">
                        <h4> Sample Picture Palettes</h4>
                    </div>
                    <div class="FooterBody">
                        <div class="ColorPalette">
                            <div>Color Palette</div>
                            <div class="dotMain">
                                <div class="dot" ></div>
                                <div>Hex:</div>
                            </div>
                            <div class="dotMain">
                                <div class="dot"></div>
                                <div>Hex:</div>
                            </div>
                            <div class="dotMain">
                                <div class="dot"></div>
                                <div>Hex:</div>
                            </div>
                        </div>
                        <div class="PhotoSection">
                            <ImageSlider slides={SliderData}/>
                        </div>
                        <div class="ColorPalette">
                            <div>Color Palette</div>
                            <div class="dotMain">
                                <div class="dot" ></div>
                                <div>Hex:</div>
                            </div>
                            <div class="dotMain">
                                <div class="dot"></div>
                                <div>Hex:</div>
                            </div>
                            <div class="dotMain">
                                <div class="dot"></div>
                                <div>Hex:</div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        )
    }
}

export default HomeFooter;