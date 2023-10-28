import { GoBell, GoAlert, GoDatabase } from "react-icons/go";
import Button from "../components/Button";

function ButtonPage() {
  return (
    <div>
      App working
      <div>
        <Button primary outline>
          <GoBell /> Click me!!
        </Button>
      </div>
      <div>
        <Button secondary>
          <GoAlert /> Save
        </Button>
      </div>
      <div>
        <Button warning rounded>
          <GoDatabase /> Cancel
        </Button>
      </div>
      <div>
        <Button danger outline>
          Ignore
        </Button>
      </div>
      <div>
        <Button success rounded outline>
          Danger
        </Button>
      </div>
    </div>
  );
}

export default ButtonPage;
