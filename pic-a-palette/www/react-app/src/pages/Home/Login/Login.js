import React,{useState} from "react";
import LoginForm from "./LoginForm";
import {NavLink, useHistory} from "react-router-dom";
import ProfileHeader from "../../Profile/ProfileHeader";
import Profile from "../../Profile/Profile";
import ProfileFooter from "../../Profile/ProfileFooter";

function Login(){
    const adminUser = {
        email: "admin@admin.com",
        password: "admin123"
    }
    const [user,setUser] = useState({name: "", email: ""});
    const [error, setError] = useState("");

    const Login = details => {
        console.log(details);

        if (details.email == adminUser.email && details.password == adminUser.password) {
            console.log("Logged In");
            setUser({
                name: details.name,
                email: details.email
            });
        }else{
            console.log("Details do not match!");
            setError("Details do not match!");
        }
    }

    const Logout = () => {
        console.log("Logout");
        setUser({
            name: "",
            email: ""
        });
    }

    return(
        <div className="LoginHome">
            {(user.email !== "") ? (
                <div>
                    <ProfileHeader/>
                    <Profile/>
                    <ProfileFooter/>
                </div>
            ) : (
                <LoginForm Login={Login} error={error}/>
            )}
        </div>
    );
}

export default Login;