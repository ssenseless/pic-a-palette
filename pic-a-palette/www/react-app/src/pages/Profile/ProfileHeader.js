import React from "react";
import { NavLink } from "react-router-dom";


class ProfileHeader extends React.Component{
    render(){
        return(
            <header class="main-header">
                <div class="HeaderDIV">
                    <div class="HeaderSec">
                        <img src="" class="HeaderPic"/>
                    </div>
                    <div class="HeaderSec">
                        <nav class="nav main-nav">
                            <li><NavLink class="Tabs" to="/">Sign-Out</NavLink></li>
                        </nav>
                    </div>
                    <div class="HeaderSec">
                        <img src="" class="HeaderPic"/>
                    </div>
                </div>
            </header>
        )
    }
}

export default ProfileHeader;
