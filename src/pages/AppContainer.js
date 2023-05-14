import { Outlet } from "react-router-dom";
import NavigationComponent from "../common/Navigation";
import Styles from "./AppContainer.module.css";

function AppContainer() {
  return (
    <div className={Styles.container}>
      <NavigationComponent />
      <Outlet />
    </div>
  );
}

export default AppContainer;
