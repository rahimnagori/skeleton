import { useState, useEffect, useRef } from "react";
import { GoChevronDown, GoChevronLeft } from "react-icons/go";
import Panel from "./Panel";

function Dropdown({ options, value, onChange }) {
  /*
    # This component expects an array of object(s).
    # The object will have
    # { label, value}
    # props
    # options - Array of object(s)
    # onSelect - Action on option select
    # selection - selection / not selected option
  */
  const [isOpen, setIsOpen] = useState(false);

  /* To close the div when click outside */
  const divEl = useRef();

  useEffect(() => {
    const handler = (event) => {
      if (!divEl.current.contains(event.target)) {
        setIsOpen(false);
      }
    };

    document.addEventListener("click", handler);
    return () => {
      document.removeEventListener("click", handler);
    };
  }, []);

  const handleClick = () => {
    /*
      # We could do a functional update here, 
      # since the new value is dependant on old value 
    */
    setIsOpen(!isOpen);
  };

  const handleOptionClick = (option) => {
    setIsOpen(false);
    onChange(option);
  };

  const renderedOptions = options.map((option) => {
    return (
      <div
        className="hover:bg-sky-100 rounded cursor-pointer p-1"
        onClick={() => handleOptionClick(option)}
        key={option.value}
      >
        {option.label}
      </div>
    );
  });

  return (
    <div ref={divEl} className="w-48 relative">
      <div>Dropdown</div>
      <Panel
        className="flex justify-between items-center cursor-pointer"
        onClick={handleClick}
      >
        {value?.label || "Select..."}
        {isOpen ? (
          <GoChevronDown className="text-lg" />
        ) : (
          <GoChevronLeft className="text-lg" />
        )}
      </Panel>
      <div>
        {isOpen && (
          <Panel className="absolute top-full">{renderedOptions}</Panel>
        )}
      </div>
    </div>
  );
}

export default Dropdown;
