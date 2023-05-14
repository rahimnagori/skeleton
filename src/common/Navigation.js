import { Link } from "react-router-dom";
import Styles from "./Navigation.module.css";

function NavigationComponent() {
  return (
    <header className={Styles.header}>
      <nav>
        <ul className={Styles.list}>
          <li className={Styles.active}>
            <Link to="/">Home</Link>
          </li>
          <li>
            <Link to="/about">About</Link>
          </li>
          <li>
            <Link to="/contact">Contact</Link>
          </li>
        </ul>
      </nav>
    </header>
  );
}

export default NavigationComponent;
