import React from "react";
import './Register.css';

class Register extends React.Component{
    render(){
        return(
            <body>
                <section class="BodySectionReg">
                    <div class="TitleDIV">
                        Register
                    </div>
                    <div class="ERE">
                        <div></div>
                        <div class="Register">
                            <div class="RSection">
                                <div>
                                    E-Mail:
                                </div>
                                <div>
                                    <input type=""/>
                                </div>
                            </div>
                            <div class="RSection">
                                <div>
                                    Username:
                                </div>
                                <div>
                                    <input type=""/>
                                </div>
                            </div>
                            <div class="RSection">
                                <div>
                                    Password:
                                </div>
                                <div>
                                    <input type=""/>
                                </div>
                            </div>
                            <div class="SignUpB">
                                <div>
                                    <button> Sign-Up </button>
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

export default Register;
