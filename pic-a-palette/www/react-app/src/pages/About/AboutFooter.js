import React from "react";
import './About.css';

class AboutFooter extends React.Component{
    render(){
        return(
            <footer class="FooterSection">
                <div class="FooterDIV">
                    <div class="FooterTitle">
                        <h4> About the Creators</h4>
                    </div>
                    <div class="FooterBodyAbout">
                        <div class="CreatorInfo">
                            <div class="CreatorName">
                                Carson
                            </div>
                            <div class="CreatorLinks">
                                Linkedin:
                                <br />
                                <br />
                                Senior at OU for Computer Engineering
                            </div>
                        </div>
                        <div class="CreatorInfo">
                            <div class="CreatorName">
                                Lester
                            </div>
                            <div class="CreatorLinks">
                                Linkedin:
                                <br />
                                <br />
                                Senior at OU for Computer Science
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        )
    }
}

export default AboutFooter;