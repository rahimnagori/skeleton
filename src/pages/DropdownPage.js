import { useState } from "react";
import Dropdown from "../components/Dropdown";

function DropwdownPage() {
  const [selection, setSelection] = useState(null);

  const handleSelect = (option) => {
    setSelection(option);
  };

  const options = [
    { label: "Red", value: "red" },
    { label: "Blue", value: "blue" },
    { label: "Green", value: "green" },
    { label: "Yellow", value: "yellow" },
  ];

  return (
    <div>
      <div>App working</div>
      <div className="flex">
        <Dropdown options={options} value={selection} onChange={handleSelect} />
      </div>
    </div>
  );
}

export default DropwdownPage;
