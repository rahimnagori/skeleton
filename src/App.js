import Button from "./Button";

function App() {
  return (
    <div>
      App working
      <Button primary>Click me!!</Button>
      <Button secondary outline>
        Save
      </Button>
      <Button warning rounded>
        Cancel
      </Button>
      <Button danger outline>
        Ignore
      </Button>
      <Button success rounded outline>
        Danger
      </Button>
    </div>
  );
}

export default App;
