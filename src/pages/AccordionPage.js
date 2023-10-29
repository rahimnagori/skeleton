import Accordion from "../components/Accordion";

function AccordionPage() {
  const items = [
    {
      id: 1,
      label: "Can I use React on a project?",
      content: "Yes you can use it!!!",
    },
    {
      id: 2,
      label: "Can I use JavaScript on a project?",
      content: "Yes you can use it!!!",
    },
    {
      id: 3,
      label: "Can I use PHP on a project?",
      content: "Yes you can use it!!!",
    },
    {
      id: 4,
      label: "Can I use WOW on a project?",
      content: "Yes you can use it!!!",
    },
  ];
  return (
    <div>
      <div>
        <Accordion items={items} />
      </div>
    </div>
  );
}

export default AccordionPage;
