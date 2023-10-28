import Button from "./Button";

function App() {
  return (
    <div>
      App working
      <div>
        <Button secondary outline>
          Click me!!
        </Button>
      </div>
      <div>
        <Button secondary outline>
          Save
        </Button>
      </div>
      <div>
        <Button warning rounded>
          Cancel
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

export default App;
